<?php
class Faktura {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM faktury ORDER BY data_wystawienia DESC");
        return $stmt->fetchAll();
    }

	public function create($dane, $pozycje) {
		$this->pdo->beginTransaction();
		try {
			// Dodajemy brakujące pola: forma_platnosci i termin_platnosci
			$stmt = $this->pdo->prepare(
				"INSERT INTO faktury (numer, data_wystawienia, kontrahent, suma_brutto, forma_platnosci, termin_platnosci)
				 VALUES (?, ?, ?, ?, ?, ?)"
			);
			$stmt->execute([
				$dane['numer'],
				$dane['data_wystawienia'],
				$dane['kontrahent'],
				$dane['suma_brutto'],
				$dane['forma_platnosci'], // Pobierane z formularza
				$dane['termin_platnosci']  // Pobierane z formularza
			]);
			
			$faktura_id = $this->pdo->lastInsertId();

			// Poprawiamy nazwy kolumn zgodnie z Twoim SQL
			$stmt2 = $this->pdo->prepare(
				"INSERT INTO faktury_pozycje (faktura_id, nazwa, ilosc, cena_netto, wartosc_brutto)
				 VALUES (?, ?, ?, ?, ?)"
			);

			foreach($pozycje as $p) {
				$stmt2->execute([
					$faktura_id,
					$p['nazwa'],
					$p['ilosc'],
					$p['cena'], // Tu musi być zgodność z HTML name="pozycje[x][cena]"
					$p['wartosc']
				]);
			}

			$this->pdo->commit();
			return $faktura_id;
		} catch (Exception $e) {
			$this->pdo->rollBack();
			throw $e;
		}
	}
}
?>