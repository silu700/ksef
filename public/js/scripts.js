console.log("scripts.js działa ✅");

// ==========================
// FAKTURY - POZYCJE + LICZENIE
// ==========================

const VAT = 0.23;

function formatPLN(value) {
    return value.toFixed(2).replace(".", ",") + " PLN";
}

function getTrybCeny() {
    const el = document.getElementById("trybCeny");
    if (!el) return "brutto";
    return el.value;
}

function przeliczWiersz(tr) {
    const iloscInput = tr.querySelector('input[name*="[ilosc]"]');
    const cenaInput = tr.querySelector('input[name*="[cena]"]');
    const wartoscInput = tr.querySelector('input[name*="[wartosc]"]');

    if (!iloscInput || !cenaInput || !wartoscInput) return;

    const ilosc = parseFloat(iloscInput.value) || 0;
    const cena = parseFloat(cenaInput.value) || 0;

    wartoscInput.value = (ilosc * cena).toFixed(2);
}

function przeliczWszystko() {
    const body = document.getElementById("pozycjeBody");
    if (!body) return;

    let suma = 0;

    [...body.children].forEach(tr => {
        przeliczWiersz(tr);

        const wartoscInput = tr.querySelector('input[name*="[wartosc]"]');
        const wartosc = parseFloat(wartoscInput.value) || 0;

        suma += wartosc;
    });

    const tryb = getTrybCeny();

    let netto = 0;
    let brutto = 0;
    let vat = 0;

    if (tryb === "brutto") {
        brutto = suma;
        netto = brutto / (1 + VAT);
        vat = brutto - netto;
    } else {
        netto = suma;
        vat = netto * VAT;
        brutto = netto + vat;
    }

    const sumNettoEl = document.getElementById("sumNetto");
    const sumVatEl = document.getElementById("sumVat");
    const sumBruttoEl = document.getElementById("sumBrutto");

    if (sumNettoEl) sumNettoEl.innerText = formatPLN(netto);
    if (sumVatEl) sumVatEl.innerText = formatPLN(vat);
    if (sumBruttoEl) sumBruttoEl.innerText = formatPLN(brutto);
}

function podlaczEventy(tr) {
    const inputs = tr.querySelectorAll("input");

    inputs.forEach(input => {
        input.addEventListener("input", () => {
            przeliczWszystko();
        });
    });
}

function dodajPozycje() {
    const body = document.getElementById("pozycjeBody");
    if (!body) {
        alert("Brak tabeli pozycji (pozycjeBody)!");
        return;
    }

    const index = body.children.length;
    const lp = index + 1;

    const tr = document.createElement("tr");
    tr.innerHTML = `
        <td class="td-lp">${lp}</td>

        <td class="td-nazwa">
            <input class="input" type="text" name="pozycje[${index}][nazwa]" required>
        </td>

        <td class="td-ilosc">
            <input class="input input-right" type="number" step="0.01" name="pozycje[${index}][ilosc]" value="1" required>
        </td>

        <td class="td-jm">
            <input class="input input-center" type="text" name="pozycje[${index}][jm]" value="szt" maxlength="5" required>
        </td>

        <td class="td-cena">
            <input class="input input-right" type="number" step="0.01" name="pozycje[${index}][cena]" value="0" required>
        </td>

        <td class="td-wartosc">
            <input class="input input-right input-readonly" type="text" name="pozycje[${index}][wartosc]" value="0.00" readonly>
        </td>

        <td class="td-akcje text-right">
            <button type="button" class="btn btn-danger" onclick="usunPozycje(this)">Usuń</button>
        </td>
    `;

    body.appendChild(tr);

    podlaczEventy(tr);
    przeliczWszystko();
}

function usunPozycje(btn) {
    const row = btn.closest("tr");
    if (row) row.remove();

    const body = document.getElementById("pozycjeBody");
    if (!body) return;

    [...body.children].forEach((tr, idx) => {
        tr.querySelector(".td-lp").innerText = idx + 1;

        tr.querySelectorAll("input").forEach(input => {
            input.name = input.name.replace(/pozycje\[\d+\]/, `pozycje[${idx}]`);
        });
    });

    przeliczWszystko();
}

// ==========================
// INIT
// ==========================

document.addEventListener("DOMContentLoaded", () => {
    console.log("DOMContentLoaded - init faktur ✅");

    const body = document.getElementById("pozycjeBody");

    if (body) {
        [...body.children].forEach(tr => podlaczEventy(tr));
        przeliczWszystko();
    }

    const tryb = document.getElementById("trybCeny");
    if (tryb) {
        tryb.addEventListener("change", () => {
            przeliczWszystko();
        });
    }
});
