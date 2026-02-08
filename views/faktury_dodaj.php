<h2 class="page-title">Wystaw fakturę</h2>

<form method="post" action="" class="form">

    <div class="card">
        <div class="section-title">Kontrahent</div>

        <div class="grid-2">
            <div>
                <label class="label">Nabywca</label>
                <input class="input" type="text" name="faktura[kontrahent]" placeholder="Wpisz nazwę kontrahenta..." required>
            </div>

            <div>
                <label class="label">NIP (na przyszłość)</label>
                <input class="input" type="text" placeholder="np. 1234567890" disabled>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="section-title">Dane transakcyjne</div>

        <div class="grid-4">
            <div>
                <label class="label">Numer faktury</label>
                <input class="input" type="text" name="faktura[numer]" placeholder="np. FS/01/2026" required>
            </div>

            <div>
                <label class="label">Data wystawienia</label>
                <input class="input" type="date" name="faktura[data_wystawienia]" required>
            </div>

            <div>
                <label class="label">Forma płatności</label>
                <select class="input" name="faktura[forma_platnosci]">
                    <option>Gotówka</option>
                    <option>Przelew</option>
                    <option>Karta</option>
                </select>
            </div>

            <div>
                <label class="label">Termin zapłaty</label>
                <input class="input" type="date" name="faktura[termin_platnosci]">
            </div>
        </div>
    </div>


    <div class="card">
        <div class="row-between">
            <div>
                <div class="section-title">Pozycje</div>

                <div class="pozycje-tryb">
                    <label class="tryb-label">Tryb ceny:</label>

                    <select class="input tryb-select" id="trybCeny">
                        <option value="brutto" selected>brutto</option>
                        <option value="netto">netto</option>
                    </select>
                </div>
            </div>

            <button type="button" class="btn btn-outline" onclick="dodajPozycje()">Dodaj pozycję</button>
        </div>

        <table class="table table-pozycje">
            <thead>
                <tr>
                    <th class="col-lp">LP</th>
                    <th class="col-nazwa">Nazwa towaru/usługi</th>
                    <th class="col-ilosc">Ilość</th>
                    <th class="col-jm">Jm</th>
                    <th class="col-cena">Cena</th>
                    <th class="col-wartosc">Wartość</th>
                    <th class="col-akcje"></th>
                </tr>
            </thead>

            <tbody id="pozycjeBody">
                <tr>
                    <td class="td-lp">1</td>

                    <td class="td-nazwa">
                        <input class="input" type="text" name="pozycje[0][nazwa]" required>
                    </td>

                    <td class="td-ilosc">
                        <input class="input input-right" type="number" step="0.01" name="pozycje[0][ilosc]" value="1" required>
                    </td>

                    <td class="td-jm">
                        <input class="input input-center" type="text" name="pozycje[0][jm]" value="szt" maxlength="5" required>
                    </td>

                    <td class="td-cena">
                        <input class="input input-right" type="number" step="0.01" name="pozycje[0][cena]" value="0" required>
                    </td>

                    <td class="td-wartosc">
                        <input class="input input-right input-readonly" type="text" name="pozycje[0][wartosc]" value="0.00" readonly>
                    </td>

                    <td class="td-akcje text-right">
                        <button type="button" class="btn btn-danger" onclick="usunPozycje(this)">Usuń</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>


    <div class="card">
        <div class="section-title">Podsumowanie</div>

        <div class="grid-3">
            <div class="summary-box">
                <div class="muted">Netto</div>
                <div class="big" id="sumNetto">0,00 PLN</div>
            </div>

            <div class="summary-box">
                <div class="muted">VAT</div>
                <div class="big" id="sumVat">0,00 PLN</div>
            </div>

            <div class="summary-box">
                <div class="muted">Brutto</div>
                <div class="big" id="sumBrutto">0,00 PLN</div>
            </div>
        </div>
    </div>


    <div class="footer-actions">
        <a class="btn btn-outline" href="index.php?page=faktury_lista">Anuluj</a>
        <button class="btn btn-primary" type="submit">Zapisz</button>
    </div>

</form>
