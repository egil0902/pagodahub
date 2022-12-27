window.onload = function () {
    cal();
}
function cal() {
    try {
        /////  Calculo de diferencia Fiscalizadora /////
        document.getElementById("x_oneamtFiscalizadora_r").innerHTML = parseFloat((document.closecash_store
            .x_oneamtFiscalizadora.value) - (document.closecash_store.x_oneamtSistema.value)).toFixed(2);
        document.getElementById("x_oneamtFiscalizadora_t").innerHTML = parseFloat((document.closecash_store
            .x_oneamtFiscalizadora.value) * 1).toFixed(2);
        document.getElementById("x_fiveamtFiscalizadora_r").innerHTML = parseFloat((document.closecash_store
            .x_fiveamtFiscalizadora.value) - (document.closecash_store.x_fiveamtSistema.value)).toFixed(2);
        document.getElementById("x_fiveamtFiscalizadora_t").innerHTML = parseFloat((document.closecash_store
            .x_fiveamtFiscalizadora.value) * 5).toFixed(2);
        document.getElementById("x_tenamtFiscalizadora_r").innerHTML = parseFloat((document.closecash_store
            .x_tenamtFiscalizadora.value) - (document.closecash_store.x_tenamtSistema.value)).toFixed(2);
        document.getElementById("x_tenamtFiscalizadora_t").innerHTML = parseFloat((document.closecash_store
            .x_tenamtFiscalizadora.value) * 10).toFixed(2);
        document.getElementById("x_twentyamtFiscalizadora_r").innerHTML = parseFloat((document.closecash_store
            .x_twentyamtFiscalizadora.value) - (document.closecash_store.x_twentyamtSistema.value)).toFixed(2);
        document.getElementById("x_twentyamtFiscalizadora_t").innerHTML = parseFloat((document.closecash_store
            .x_twentyamtFiscalizadora.value) * 20).toFixed(2);
        document.getElementById("x_fiftyamtFiscalizadora_r").innerHTML = parseFloat((document.closecash_store
            .x_fiftyamtFiscalizadora.value) - (document.closecash_store.x_fiftyamtSistema.value)).toFixed(2);
        document.getElementById("x_fiftyamtFiscalizadora_t").innerHTML = parseFloat((document.closecash_store
            .x_fiftyamtFiscalizadora.value) * 50).toFixed(2);
        document.getElementById("x_hundredamtFiscalizadora_r").innerHTML = parseFloat((document.closecash_store
            .x_hundredamtFiscalizadora.value) - (document.closecash_store.x_hundredamtSistema.value)).toFixed(2);
        document.getElementById("x_hundredamtFiscalizadora_t").innerHTML = parseFloat((document.closecash_store
            .x_hundredamtFiscalizadora.value) * 100).toFixed(2);
        document.getElementById("Fiscalizadora_t").innerHTML = parseFloat(document.getElementById(
            "x_oneamtFiscalizadora_t").innerHTML) + parseFloat(document.getElementById(
                "x_fiveamtFiscalizadora_t").innerHTML) + parseFloat(document.getElementById(
                    "x_tenamtFiscalizadora_t").innerHTML) + parseFloat(document.getElementById(
                        "x_twentyamtFiscalizadora_t").innerHTML) + parseFloat(document.getElementById(
                            "x_fiftyamtFiscalizadora_t").innerHTML) + parseFloat(document.getElementById(
                                "x_hundredamtFiscalizadora_t").innerHTML);
        /////  Calculo de diferencia Fiscalizadora  Fin/////

        /////  Calculo de diferencia Gerente /////
        document.getElementById("x_oneamtGerente_r").innerHTML = parseFloat((document.closecash_store
            .x_oneamtGerente.value) - (document.closecash_store.x_oneamtFiscalizadora.value)).toFixed(2);
        document.getElementById("x_oneamtGerente_t").innerHTML = parseFloat((document.closecash_store
            .x_oneamtGerente.value) * 1).toFixed(2);
        document.getElementById("x_fiveamtGerente_r").innerHTML = parseFloat((document.closecash_store
            .x_fiveamtGerente.value) - (document.closecash_store.x_fiveamtFiscalizadora.value)).toFixed(2);
        document.getElementById("x_fiveamtGerente_t").innerHTML = parseFloat((document.closecash_store
            .x_fiveamtGerente.value) * 5).toFixed(2);
        document.getElementById("x_tenamtGerente_r").innerHTML = parseFloat((document.closecash_store
            .x_tenamtGerente.value) - (document.closecash_store.x_tenamtFiscalizadora.value)).toFixed(2);
        document.getElementById("x_tenamtGerente_t").innerHTML = parseFloat((document.closecash_store
            .x_tenamtGerente.value) * 10).toFixed(2);
        document.getElementById("x_twentyamtGerente_r").innerHTML = parseFloat((document.closecash_store
            .x_twentyamtGerente.value) - (document.closecash_store.x_twentyamtFiscalizadora.value)).toFixed(2);
        document.getElementById("x_twentyamtGerente_t").innerHTML = parseFloat((document.closecash_store
            .x_twentyamtGerente.value) * 20).toFixed(2);
        document.getElementById("x_fiftyamtGerente_r").innerHTML = parseFloat((document.closecash_store
            .x_fiftyamtGerente.value) - (document.closecash_store.x_fiftyamtFiscalizadora.value)).toFixed(2);
        document.getElementById("x_fiftyamtGerente_t").innerHTML = parseFloat((document.closecash_store
            .x_fiftyamtGerente.value) * 50).toFixed(2);
        document.getElementById("x_hundredamtGerente_r").innerHTML = parseFloat((document.closecash_store
            .x_hundredamtGerente.value) - (document.closecash_store.x_hundredamtFiscalizadora.value)).toFixed(2);
        document.getElementById("x_hundredamtGerente_t").innerHTML = parseFloat((document.closecash_store
            .x_hundredamtGerente.value) * 100).toFixed(2);
        document.getElementById("Gerente_t").innerHTML = parseFloat(document.getElementById("x_oneamtGerente_t")
            .innerHTML) + parseFloat(document.getElementById("x_fiveamtGerente_t").innerHTML) + parseFloat(
                document.getElementById("x_tenamtGerente_t").innerHTML) + parseFloat(document.getElementById(
                    "x_twentyamtGerente_t").innerHTML) + parseFloat(document.getElementById("x_fiftyamtGerente_t")
                        .innerHTML) + parseFloat(document.getElementById("x_hundredamtGerente_t").innerHTML);
        /////  Calculo de diferencia Fiscalizadora  Fin/////

        /////  Calculo de diferencia  OTROS Fiscalizadora 11c/////
        ////Inicializacion de Facturas
        let otrosFiscalizadora_suma = 0;
        let otrosprimeroFiscalizadora_suma = 0;
        let InvoiceAmtFiscalizadora_suma = 0;
        let InvoiceAmtPropiasFiscalizadora_suma = 0;
        let CardClaveFiscalizadora_suma = 0;
        let CardValeFiscalizadora_suma = 0;
        let CardVisaFiscalizadora_suma = 0;
        let CardMasterFiscalizadora_suma = 0;
        let CardAEFiscalizadora_suma = 0;
        let CardBACFiscalizadora_suma = 0;
        //otros
        if (isNaN(parseFloat(document.closecash_store.otrosFiscalizadora.value))) {
            otrosFiscalizadora_suma = 0;
        } else {
            otrosFiscalizadora_suma = parseFloat(document.closecash_store.otrosFiscalizadora.value);
        }
        if (isNaN(parseFloat(document.closecash_store.otrosprimeroFiscalizadora.value))) {
            otrosprimeroFiscalizadora_suma = 0;
        } else {
            otrosprimeroFiscalizadora_suma = parseFloat(document.closecash_store.otrosprimeroFiscalizadora.value);
        }
        //
        if (isNaN(parseFloat(document.closecash_store.InvoiceAmtFiscalizadora.value))) {
            InvoiceAmtFiscalizadora_suma = 0;
        } else {
            InvoiceAmtFiscalizadora_suma = parseFloat(document.closecash_store.InvoiceAmtFiscalizadora.value);
        }
        if (isNaN(parseFloat(document.closecash_store.InvoiceAmtPropiasFiscalizadora.value))) {
            InvoiceAmtPropiasFiscalizadora_suma = 0;
        } else {
            InvoiceAmtPropiasFiscalizadora_suma = parseFloat(document.closecash_store.InvoiceAmtPropiasFiscalizadora
                .value);
        }
        /// Inicializacion de Tarjetas
        if (isNaN(parseFloat(document.closecash_store.CardClaveFiscalizadora.value))) {
            CardClaveFiscalizadora_suma = 0;
        } else {
            CardClaveFiscalizadora_suma = parseFloat(document.closecash_store.CardClaveFiscalizadora.value);
        }
        if (isNaN(parseFloat(document.closecash_store.CardValeFiscalizadora.value))) {
            CardValeFiscalizadora_suma = 0;
        } else {
            CardValeFiscalizadora_suma = parseFloat(document.closecash_store.CardValeFiscalizadora.value)
        }
        if (isNaN(parseFloat(document.closecash_store.CardVisaFiscalizadora.value))) {
            CardVisaFiscalizadora_suma = 0;
        } else {
            CardVisaFiscalizadora_suma = parseFloat(document.closecash_store.CardVisaFiscalizadora.value);
        }
        if (isNaN(parseFloat(document.closecash_store.CardMasterFiscalizadora.value))) {
            CardMasterFiscalizadora_suma = 0;
        } else {
            CardMasterFiscalizadora_suma = parseFloat(document.closecash_store.CardMasterFiscalizadora.value);
        }
        if (isNaN(parseFloat(document.closecash_store.CardAEFiscalizadora.value))) {
            CardAEFiscalizadora_suma = 0;
        } else {
            CardAEFiscalizadora_suma = parseFloat(document.closecash_store.CardAEFiscalizadora.value);
        }
        if (isNaN(parseFloat(document.closecash_store.CardBACFiscalizadora.value))) {
            CardBACFiscalizadora_suma = 0;
        } else {
            CardBACFiscalizadora_suma = parseFloat(document.closecash_store.CardBACFiscalizadora.value);
        }
        const card = parseFloat(CardClaveFiscalizadora_suma + CardValeFiscalizadora_suma +
            CardVisaFiscalizadora_suma + CardMasterFiscalizadora_suma + CardAEFiscalizadora_suma +
            CardBACFiscalizadora_suma).toFixed(2);
        document.getElementById("yappyFiscalizadora_r").innerHTML = parseFloat((document.closecash_store
            .yappyFiscalizadora.value) - (document.closecash_store.yappySistema.value)).toFixed(2);

        //otros
        document.getElementById("otrosFiscalizadora_r").innerHTML = parseFloat((otrosFiscalizadora_suma +
            otrosprimeroFiscalizadora_suma) - document.closecash_store.otrosSistema.value).toFixed(2);
        //
        document.getElementById("valespagodaFiscalizadora_r").innerHTML = parseFloat((document.closecash_store
            .valespagodaFiscalizadora.value) - (document.closecash_store.valespagodaSistema.value)).toFixed(2);
        document.getElementById("CheckAmtFiscalizadora_r").innerHTML = parseFloat((document.closecash_store
            .CheckAmtFiscalizadora.value) - (document.closecash_store.CheckAmtSistema.value)).toFixed(2);
        document.getElementById("LotoAmtFiscalizadora_r").innerHTML = parseFloat((document.closecash_store
            .LotoAmtFiscalizadora.value) - (document.closecash_store.LotoAmtSistema.value)).toFixed(2);
        document.getElementById("CashAmtFiscalizadora_r").innerHTML = parseFloat((document.closecash_store
            .CashAmtFiscalizadora.value) - (document.closecash_store.CashAmtSistema.value)).toFixed(2);
        document.getElementById("CoinRollFiscalizadora_r").innerHTML = parseFloat((document.closecash_store
            .CoinRollFiscalizadora.value) - (document.closecash_store.CoinRollSistema.value)).toFixed(2);
        document.getElementById("VoucherAmtFiscalizadora_r").innerHTML = parseFloat((document.closecash_store
            .VoucherAmtFiscalizadora.value) - (document.closecash_store.VoucherAmtSistema.value)).toFixed(2);
        document.getElementById("GrantAmtFiscalizadora_r").innerHTML = parseFloat((document.closecash_store
            .GrantAmtFiscalizadora.value) - (document.closecash_store.GrantAmtSistema.value)).toFixed(2);
        document.getElementById("valeAmtFiscalizadora_r").innerHTML = parseFloat((document.closecash_store
            .valeAmtFiscalizadora.value) - (document.closecash_store.valeAmt.value)).toFixed(2);
        document.getElementById("InvoiceAmtFiscalizadora_r").innerHTML = parseFloat((InvoiceAmtFiscalizadora_suma +
            InvoiceAmtPropiasFiscalizadora_suma) - document.closecash_store.InvoiceAmtSistema.value).toFixed(2);
        document.getElementById("CardClaveFiscalizadora_r").innerHTML = parseFloat(card - document.closecash_store
            .CardAmtSistema.value).toFixed(2);
        document.getElementById("CardValeFiscalizadora_r").innerHTML = parseFloat(card - document.closecash_store
            .CardAmtSistema.value).toFixed(2);
        document.getElementById("CardVisaFiscalizadora_r").innerHTML = parseFloat(card - document.closecash_store
            .CardAmtSistema.value).toFixed(2);
        document.getElementById("CardMasterFiscalizadora_r").innerHTML = parseFloat(card - document.closecash_store
            .CardAmtSistema.value).toFixed(2);
        document.getElementById("CardAEFiscalizadora_r").innerHTML = parseFloat(card - document.closecash_store
            .CardAmtSistema.value).toFixed(2);
        document.getElementById("CardBACFiscalizadora_r").innerHTML = parseFloat(card - document.closecash_store
            .CardBACSistema.value).toFixed(2);
        /////  Calculo de diferencia  OTROS Fiscalizadora Fin/////

        /////  Calculo de diferencia  OTROS Gerente 11c /////

        let CardClaveGerente_suma = 0;
        let CardValeGerente_suma = 0;
        let CardVisaGerente_suma = 0;
        let CardMasterGerente_suma = 0;
        let CardAEGerente_suma = 0;
        let CardBACGerente_suma = 0;
        const cardg = parseFloat(parseFloat(document.closecash_store.CardClaveGerente.value) + parseFloat(document
            .closecash_store.CardValeGerente.value) + parseFloat(document.closecash_store.CardVisaGerente
                .value) + parseFloat(document.closecash_store.CardMasterGerente.value) + parseFloat(document
                    .closecash_store.CardAEGerente.value) + parseFloat(document.closecash_store.CardBACGerente
                        .value)).toFixed(2);
        document.getElementById("CardClaveGerente_r").innerHTML = parseFloat(cardg - card).toFixed(2);
        document.getElementById("CardValeGerente_r").innerHTML = parseFloat(cardg - card).toFixed(2);
        document.getElementById("CardVisaGerente_r").innerHTML = parseFloat(cardg - card).toFixed(2);
        document.getElementById("CardMasterGerente_r").innerHTML = parseFloat(cardg - card).toFixed(2);
        document.getElementById("CardAEGerente_r").innerHTML = parseFloat(cardg - card).toFixed(2);
        document.getElementById("CardBACGerente_r").innerHTML = parseFloat(cardg - card).toFixed(2);

        /////  Calculo de diferencia  OTROS Gerente Fin /////
        ///tarjetas
        if (isNaN(document.getElementById("CardClaveFiscalizadora_r").innerHTML)) {
            //cambioCardVisaFiscalizadora.classList.replace("text-success", "text-white");
            document.getElementById("CardClaveFiscalizadora_r").innerHTML = -(document.closecash_store
                .CardAmtSistema.value);
        }
        if (isNaN(document.getElementById("CardValeFiscalizadora_r").innerHTML)) {
            //cambioCardVisaFiscalizadora.classList.replace("text-success", "text-white");
            document.getElementById("CardValeFiscalizadora_r").innerHTML = -(document.closecash_store.CardAmtSistema
                .value);
        }
        if (isNaN(document.getElementById("CardVisaFiscalizadora_r").innerHTML)) {
            //cambioCardVisaFiscalizadora.classList.replace("text-success", "text-white");
            document.getElementById("CardVisaFiscalizadora_r").innerHTML = -(document.closecash_store.CardAmtSistema
                .value);
        }
        if (isNaN(document.getElementById("CardMasterFiscalizadora_r").innerHTML)) {
            //cambioCardVisaFiscalizadora.classList.replace("text-success", "text-white");
            document.getElementById("CardMasterFiscalizadora_r").innerHTML = -(document.closecash_store
                .CardAmtSistema.value);
        }
        if (isNaN(document.getElementById("CardAEFiscalizadora_r").innerHTML)) {
            //cambioCardVisaFiscalizadora.classList.replace("text-success", "text-white");
            document.getElementById("CardAEFiscalizadora_r").innerHTML = -(document.closecash_store.CardAmtSistema
                .value);
        }
        /////////////////////////////////////////////////////////////////////////////////

        document.getElementById("CardClaveGerente_r").innerHTML = parseFloat(document.closecash_store
            .CardClaveGerente.value - document.closecash_store.CardClaveFiscalizadora.value).toFixed(2);
        document.getElementById("CardValeGerente_r").innerHTML = parseFloat(document.closecash_store.CardValeGerente
            .value - document.closecash_store.CardValeFiscalizadora.value).toFixed(2);
        document.getElementById("CardVisaGerente_r").innerHTML = parseFloat(document.closecash_store.CardVisaGerente
            .value - document.closecash_store.CardVisaFiscalizadora.value).toFixed(2);
        document.getElementById("CardMasterGerente_r").innerHTML = parseFloat(document.closecash_store
            .CardMasterGerente.value - document.closecash_store.CardMasterFiscalizadora.value).toFixed(2);
        document.getElementById("CardAEGerente_r").innerHTML = parseFloat(document.closecash_store.CardAEGerente
            .value - document.closecash_store.CardAEFiscalizadora.value).toFixed(2);

        document.getElementById("Otros_Gerente_t").innerHTML = -1 * (parseFloat(-
            (document.getElementById("yappyGerente_r").innerHTML) -
            (document.getElementById("otrosGerente_r").innerHTML) -
            (document.getElementById("valespagodaGerente_r").innerHTML) -
            (document.getElementById("CheckAmtGerente_r").innerHTML) -
            (document.getElementById("LotoAmtGerente_r").innerHTML) -
            (document.getElementById("CashAmtGerente_r").innerHTML) -
            (document.getElementById("CoinRollGerente_r").innerHTML) -
            (document.getElementById("InvoiceAmtGerente_r").innerHTML) -
            (document.getElementById("VoucherAmtGerente_r").innerHTML) -
            (document.getElementById("GrantAmtGerente_r").innerHTML) -
            (document.getElementById("CardClaveGerente_r").innerHTML) -
            (document.getElementById("CardValeGerente_r").innerHTML) -
            (document.getElementById("CardVisaGerente_r").innerHTML) -
            (document.getElementById("CardMasterGerente_r").innerHTML) -
            (document.getElementById("CardAEGerente_r").innerHTML) -
            (document.getElementById("valeAmtGerente_r").innerHTML)
        ).toFixed(2));

        document.getElementById("Otros_Gerente_total").innerHTML = parseFloat(-1 * (document.getElementById(
            "Otros_Gerente_t").innerHTML - document.getElementById("Otros_Fiscalizadora_t").innerHTML)).toFixed(
                2);
        document.getElementById("Monto_Gerente_t").innerHTML = parseFloat(parseFloat(document.getElementById(
            "Gerente_t").innerHTML) + parseFloat(document.getElementById("Otros_Gerente_t").innerHTML)).toFixed(
                2);

        const cambioMonto_Gerente_t = document.getElementById("Monto_Gerente_t");



        if (document.getElementById("Monto_Gerente_t").innerHTML < document.getElementById("Monto_Fiscalizadora_t")
            .innerHTML) {
            cambioMonto_Gerente_t.classList.replace("text-success", "text-danger");
        } else {
            cambioMonto_Gerente_t.classList.replace("text-success", "text-success");
            cambioMonto_Gerente_t.classList.replace("text-danger", "text-success");
        }


    } catch (e) {

        document.getElementById("yappyGerente_r").innerHTML = parseFloat(document.closecash_store.yappyGerente
            .value - document.closecash_store.yappyFiscalizadora.value).toFixed(2);
        document.getElementById("otrosGerente_r").innerHTML = parseFloat(document.closecash_store.otrosGerente
            .value - document.closecash_store.otrosFiscalizadora.value).toFixed(2);
        //otros
        document.getElementById("otrosprimeroGerente_r").innerHTML = parseFloat(document.closecash_store
            .otrosprimeroGerente.value - document.closecash_store.otrosprimeroFiscalizadora.value)
            .toFixed(2);
        //
        document.getElementById("valespagodaGerente_r").innerHTML = parseFloat(document.closecash_store
            .valespagodaGerente.value - document.closecash_store.valespagodaFiscalizadora.value).toFixed(2);
        document.getElementById("CheckAmtGerente_r").innerHTML = parseFloat(document.closecash_store.CheckAmtGerente
            .value - document.closecash_store.CheckAmtFiscalizadora.value).toFixed(2);
        document.getElementById("LotoAmtGerente_r").innerHTML = parseFloat(document.closecash_store.LotoAmtGerente
            .value - document.closecash_store.LotoAmtFiscalizadora.value).toFixed(2);
        document.getElementById("CashAmtGerente_r").innerHTML = parseFloat(document.closecash_store.CashAmtGerente
            .value - document.closecash_store.CashAmtFiscalizadora.value).toFixed(2);
        document.getElementById("CardClaveGerente_r").innerHTML = parseFloat(document.closecash_store
            .CardClaveGerente.value - document.closecash_store.CardClaveFiscalizadora.value).toFixed(2);
        document.getElementById("CardValeGerente_r").innerHTML = parseFloat(document.closecash_store.CardValeGerente
            .value - document.closecash_store.CardValeFiscalizadora.value).toFixed(2);
        document.getElementById("CardVisaGerente_r").innerHTML = parseFloat(document.closecash_store.CardVisaGerente
            .value - document.closecash_store.CardVisaFiscalizadora.value).toFixed(2);
        document.getElementById("CardMasterGerente_r").innerHTML = parseFloat(document.closecash_store
            .CardMasterGerente.value - document.closecash_store.CardMasterFiscalizadora.value).toFixed(2);
        document.getElementById("CardAEGerente_r").innerHTML = parseFloat(document.closecash_store.CardAEGerente
            .value - document.closecash_store.CardAEFiscalizadora.value).toFixed(2);
        document.getElementById("CardBACGerente_r").innerHTML = parseFloat(document.closecash_store.CardBACGerente
            .value - document.closecash_store.CardBACFiscalizadora.value).toFixed(2);
        document.getElementById("CoinRollGerente_r").innerHTML = parseFloat(document.closecash_store.CoinRollGerente
            .value - document.closecash_store.CoinRollFiscalizadora.value).toFixed(2);
        document.getElementById("InvoiceAmtGerente_r").innerHTML = parseFloat(document.closecash_store
            .InvoiceAmtGerente.value - document.closecash_store.InvoiceAmtFiscalizadora.value).toFixed(2);
        document.getElementById("InvoiceAmtPropiasGerente_r").innerHTML = parseFloat(document.closecash_store
            .InvoiceAmtPropiasGerente.value - document.closecash_store.InvoiceAmtPropiasFiscalizadora.value)
            .toFixed(2);
        document.getElementById("VoucherAmtGerente_r").innerHTML = parseFloat(document.closecash_store
            .VoucherAmtGerente.value - document.closecash_store.VoucherAmtFiscalizadora.value).toFixed(2);
        document.getElementById("GrantAmtGerente_r").innerHTML = parseFloat(document.closecash_store.GrantAmtGerente
            .value - document.closecash_store.GrantAmtFiscalizadora.value).toFixed(2);
        document.getElementById("valeAmtGerente_r").innerHTML = parseFloat(document.closecash_store.valeAmtGerente
            .value - document.closecash_store.valeAmtFiscalizadora.value).toFixed(2);

        let yappyGerente_NaN = 0;
        let otrosGerente_NaN = 0;
        let otrosprimeroGerente_NaN = 0;
        let valespagodaGerente_NaN = 0;
        let CheckAmtGerente_NaN = 0;
        let LotoAmtGerente_NaN = 0;
        let valeAmtGerente_NaN = 0;
        let CashAmtGerente_NaN = 0;
        let CoinRollGerente_NaN = 0;
        let InvoiceAmtGerente_NaN = 0;
        let VoucherAmtGerente_NaN = 0;
        let InvoiceAmtPropiasGerente_NaN = 0;
        let GrantAmtGerente_NaN = 0;
        let CardClaveGerente_NaN = 0;
        let CardValeGerente_NaN = 0;
        let CardVisaGerente_NaN = 0;
        let CardMasterGerente_NaN = 0;
        let CardAEGerente_NaN = 0;
        let CardBACGerente_NaN = 0;

        if (isNaN(parseFloat(document.closecash_store.yappyGerente.value))) {
            yappyGerente_NaN = 0;
        } else {
            yappyGerente_NaN = parseFloat(document.closecash_store.yappyGerente.value).toFixed(2);;
        }
        if (isNaN(parseFloat(document.closecash_store.otrosGerente.value))) {
            otrosGerente_NaN = 0;
        } else {
            otrosGerente_NaN = parseFloat(document.closecash_store.otrosGerente.value).toFixed(2);;
        }
        //otros
        if (isNaN(parseFloat(document.closecash_store.otrosprimeroGerente.value))) {
            otrosprimeroPropiasGerente_NaN = 0;
        } else {
            otrosprimeroGerente_NaN = parseFloat(document.closecash_store.otrosprimeroGerente.value)
                .toFixed(2);
        }
        //
        if (isNaN(parseFloat(document.closecash_store.valespagodaGerente.value))) {
            valespagodaGerente_NaN = 0;
        } else {
            valespagodaGerente_NaN = parseFloat(document.closecash_store.valespagodaGerente.value).toFixed(2);;
        }
        if (isNaN(parseFloat(document.closecash_store.CheckAmtGerente.value))) {
            CheckAmtGerente_NaN = 0;
        } else {
            CheckAmtGerente_NaN = parseFloat(document.closecash_store.CheckAmtGerente.value).toFixed(2);;
        }
        if (isNaN(parseFloat(document.closecash_store.LotoAmtGerente.value))) {
            LotoAmtGerente_NaN = 0;
        } else {
            LotoAmtGerente_NaN = parseFloat(document.closecash_store.LotoAmtGerente.value).toFixed(2);
        }
        if (isNaN(parseFloat(document.closecash_store.valeAmtGerente.value))) {
            valeAmtGerente_NaN = 0;
        } else {
            valeAmtGerente_NaN = parseFloat(document.closecash_store.valeAmtGerente.value).toFixed(2);
        }
        if (isNaN(parseFloat(document.closecash_store.CashAmtGerente.value))) {
            CashAmtGerente_NaN = 0;
        } else {
            CashAmtGerente_NaN = parseFloat(document.closecash_store.CashAmtGerente.value).toFixed(2);
        }
        if (isNaN(parseFloat(document.closecash_store.CoinRollGerente.value))) {
            CoinRollGerente_NaN = 0;
        } else {
            CoinRollGerente_NaN = parseFloat(document.closecash_store.CoinRollGerente.value).toFixed(2);
        }
        if (isNaN(parseFloat(document.closecash_store.InvoiceAmtGerente.value))) {
            InvoiceAmtGerente_NaN = 0;
        } else {
            InvoiceAmtGerente_NaN = parseFloat(document.closecash_store.InvoiceAmtGerente.value).toFixed(2);
        }
        if (isNaN(parseFloat(document.closecash_store.VoucherAmtGerente.value))) {
            VoucherAmtGerente_NaN = 0;
        } else {
            VoucherAmtGerente_NaN = parseFloat(document.closecash_store.VoucherAmtGerente.value).toFixed(2);
        }
        if (isNaN(parseFloat(document.closecash_store.InvoiceAmtPropiasGerente.value))) {
            InvoiceAmtPropiasGerente_NaN = 0;
        } else {
            InvoiceAmtPropiasGerente_NaN = parseFloat(document.closecash_store.InvoiceAmtPropiasGerente.value)
                .toFixed(2);
        }
        if (isNaN(parseFloat(document.closecash_store.GrantAmtGerente.value))) {
            GrantAmtGerente_NaN = 0;
        } else {
            GrantAmtGerente_NaN = parseFloat(document.closecash_store.GrantAmtGerente.value).toFixed(2);
        }
        ///clave
        if (isNaN(parseFloat(document.closecash_store.CardClaveGerente.value))) {
            CardClaveGerente_NaN = 0;
        } else {
            CardClaveGerente_NaN = parseFloat(document.closecash_store.CardClaveGerente.value).toFixed(2);
        }
        ///
        if (isNaN(parseFloat(document.closecash_store.CardValeGerente.value))) {
            CardValeGerente_NaN = 0;
        } else {
            CardValeGerente_NaN = parseFloat(document.closecash_store.CardValeGerente.value).toFixed(2);
        }

        if (isNaN(parseFloat(document.closecash_store.CardVisaGerente.value))) {
            CardVisaGerente_NaN = 0;
        } else {
            CardVisaGerente_NaN = parseFloat(document.closecash_store.CardVisaGerente.value).toFixed(2);
        }

        if (isNaN(parseFloat(document.closecash_store.CardMasterGerente.value))) {
            CardMasterGerente_NaN = 0;
        } else {
            CardMasterGerente_NaN = parseFloat(document.closecash_store.CardMasterGerente.value).toFixed(2);
        }
        if (isNaN(parseFloat(document.closecash_store.CardAEGerente.value))) {
            CardAEGerente_NaN = 0;
        } else {
            CardAEGerente_NaN = parseFloat(document.closecash_store.CardAEGerente.value).toFixed(2);
        }
        if (isNaN(parseFloat(document.closecash_store.CardBACGerente.value))) {
            CardBACGerente_NaN = 0;
        } else {
            CardBACGerente_NaN = parseFloat(document.closecash_store.CardBACGerente.value).toFixed(2);
        }
        document.getElementById("yappyGerente_t").innerHTML = yappyGerente_NaN;
        document.getElementById("otrosGerente_t").innerHTML = otrosGerente_NaN;
        document.getElementById("otrosprimeroGerente_t").innerHTML = otrosprimeroGerente_NaN;
        document.getElementById("valespagodaGerente_t").innerHTML = valespagodaGerente_NaN;
        document.getElementById("CheckAmtGerente_t").innerHTML = CheckAmtGerente_NaN;
        document.getElementById("LotoAmtGerente_t").innerHTML = LotoAmtGerente_NaN;
        document.getElementById("valeAmtGerente_t").innerHTML = valeAmtGerente_NaN;
        document.getElementById("CashAmtGerente_t").innerHTML = CashAmtGerente_NaN;
        document.getElementById("CoinRollGerente_t").innerHTML = CoinRollGerente_NaN;
        document.getElementById("InvoiceAmtGerente_t").innerHTML = InvoiceAmtGerente_NaN;
        document.getElementById("VoucherAmtGerente_t").innerHTML = VoucherAmtGerente_NaN;
        document.getElementById("InvoiceAmtPropiasGerente_t").innerHTML = InvoiceAmtPropiasGerente_NaN;
        document.getElementById("GrantAmtGerente_t").innerHTML = GrantAmtGerente_NaN;
        document.getElementById("CardClaveGerente_t").innerHTML = CardClaveGerente_NaN;
        document.getElementById("CardValeGerente_t").innerHTML = CardValeGerente_NaN;
        document.getElementById("CardVisaGerente_t").innerHTML = CardVisaGerente_NaN;
        document.getElementById("CardMasterGerente_t").innerHTML = CardMasterGerente_NaN;
        document.getElementById("CardAEGerente_t").innerHTML = CardAEGerente_NaN;
        document.getElementById("CardBACGerente_t").innerHTML = CardBACGerente_NaN;

    }
    document.getElementById("Otros_Fiscalizadora_t").innerHTML = -1 * (parseFloat(-
        (document.getElementById("yappyFiscalizadora_r").innerHTML) -
        (document.getElementById("otrosFiscalizadora_r").innerHTML) -
        (document.getElementById("valespagodaFiscalizadora_r").innerHTML) -
        (document.getElementById("CheckAmtFiscalizadora_r").innerHTML) -
        (document.getElementById("LotoAmtFiscalizadora_r").innerHTML) -
        (document.getElementById("CashAmtFiscalizadora_r").innerHTML) -
        (document.getElementById("CoinRollFiscalizadora_r").innerHTML) -
        (document.getElementById("InvoiceAmtFiscalizadora_r").innerHTML) -
        (document.getElementById("VoucherAmtFiscalizadora_r").innerHTML) -
        (document.getElementById("GrantAmtFiscalizadora_r").innerHTML) -
        (document.getElementById("CardClaveFiscalizadora_r").innerHTML) -
        (document.getElementById("valeAmtFiscalizadora_r").innerHTML) -
        (document.getElementById("Otros").innerHTML)
    ).toFixed(2));
    document.getElementById("Monto_Fiscalizadora_t").innerHTML = parseFloat(parseFloat(document.getElementById(
        "Fiscalizadora_t").innerHTML) + parseFloat(document.getElementById("Otros_Fiscalizadora_t")
            .innerHTML)).toFixed(2);
    document.getElementById("Monto_contado_Fiscalizadora").innerHTML = parseFloat(document.getElementById(
        "Monto_Fiscalizadora_t").innerHTML - document.getElementById("InicioCaja").innerHTML).toFixed(2);
    document.getElementById("Diferencia_Fiscalizadora").innerHTML = parseFloat(parseFloat(document.getElementById(
        "Monto_contado_Fiscalizadora").innerHTML) - parseFloat(document.getElementById(
            "Monto_X_Fiscalizadora").innerHTML)).toFixed(2);


    document.getElementById("Otros_Gerente_t").innerHTML = parseFloat(
        parseFloat((document.getElementById("yappyGerente_t").innerHTML)) +
        parseFloat((document.getElementById("otrosGerente_t").innerHTML)) +
        parseFloat((document.getElementById("otrosprimeroGerente_t").innerHTML)) +
        parseFloat((document.getElementById("valespagodaGerente_t").innerHTML)) +
        parseFloat((document.getElementById("CheckAmtGerente_t").innerHTML)) +
        parseFloat((document.getElementById("LotoAmtGerente_t").innerHTML)) +
        parseFloat((document.getElementById("valeAmtGerente_t").innerHTML)) +
        parseFloat((document.getElementById("CashAmtGerente_t").innerHTML)) +
        parseFloat((document.getElementById("CoinRollGerente_t").innerHTML)) +
        parseFloat((document.getElementById("InvoiceAmtGerente_t").innerHTML)) +
        parseFloat((document.getElementById("VoucherAmtGerente_t").innerHTML)) +
        parseFloat((document.getElementById("InvoiceAmtPropiasGerente_t").innerHTML)) +
        parseFloat((document.getElementById("GrantAmtGerente_t").innerHTML)) +
        parseFloat((document.getElementById("CardClaveGerente_t").innerHTML)) +
        parseFloat((document.getElementById("CardValeGerente_t").innerHTML)) +
        parseFloat((document.getElementById("CardVisaGerente_t").innerHTML)) +
        parseFloat((document.getElementById("CardMasterGerente_t").innerHTML)) +
        parseFloat((document.getElementById("CardAEGerente_t").innerHTML)) +
        parseFloat((document.getElementById("CardBACGerente_t").innerHTML))).toFixed(2);;
    document.getElementById("Monto_Gerente_t").innerHTML = parseFloat(parseFloat(document.getElementById(
        "Gerente_t").innerHTML) + parseFloat(document.getElementById("Otros_Gerente_t").innerHTML)).toFixed(2);
    document.getElementById("Monto_contado_Gerente").innerHTML = parseFloat(document.getElementById(
        "Monto_Gerente_t").innerHTML - document.getElementById("InicioCaja").innerHTML).toFixed(2);
    document.getElementById("Monto_Diferencia_t").innerHTML = parseFloat(parseFloat(document.getElementById(
        "Monto_contado_Gerente").innerHTML) - parseFloat(document.getElementById("Monto_X_t").innerHTML))
        .toFixed(2);
}

function colores() {
    const cambio1 = document.getElementById("x_oneamtFiscalizadora_r");
    const cambio5 = document.getElementById("x_fiveamtFiscalizadora_r");
    const cambio10 = document.getElementById("x_tenamtFiscalizadora_r");
    const cambio20 = document.getElementById("x_twentyamtFiscalizadora_r");
    const cambio50 = document.getElementById("x_fiftyamtFiscalizadora_r");
    const cambio100 = document.getElementById("x_hundredamtFiscalizadora_r");
    const cambiototalfis = document.getElementById("Fiscalizadora_t");
    if (document.getElementById("x_oneamtFiscalizadora_r").innerHTML <= -0.01) {
        cambio1.classList.replace("text-success", "text-danger");
    } else {
        cambio1.classList.replace("text-success", "text-success");
        cambio1.classList.replace("text-danger", "text-success");
    }
    if (document.getElementById("x_fiveamtFiscalizadora_r").innerHTML <= -0.01) {
        cambio5.classList.replace("text-success", "text-danger");
    } else {
        cambio5.classList.replace("text-success", "text-success");
        cambio5.classList.replace("text-danger", "text-success");
    }
    if (document.getElementById("x_tenamtFiscalizadora_r").innerHTML <= -0.01) {
        cambio10.classList.replace("text-success", "text-danger");
    } else {
        cambio10.classList.replace("text-success", "text-success");
        cambio10.classList.replace("text-danger", "text-success");
    }
    if (document.getElementById("x_twentyamtFiscalizadora_r").innerHTML <= -0.01) {
        cambio20.classList.replace("text-success", "text-danger");
    } else {
        cambio20.classList.replace("text-success", "text-success");
        cambio20.classList.replace("text-danger", "text-success");
    }
    if (document.getElementById("x_fiftyamtFiscalizadora_r").innerHTML <= -0.01) {
        cambio50.classList.replace("text-success", "text-danger");
    } else {
        cambio50.classList.replace("text-success", "text-success");
        cambio50.classList.replace("text-danger", "text-success");
    }
    if (document.getElementById("x_hundredamtFiscalizadora_r").innerHTML <= -0.01) {
        cambio100.classList.replace("text-success", "text-danger");
    } else {
        cambio100.classList.replace("text-success", "text-success");
        cambio100.classList.replace("text-danger", "text-success");
    }
    if (parseFloat(document.getElementById("Fiscalizadora_t").innerHTML) < parseFloat(document.getElementById(
        "Montosistema_t").innerHTML)) {
        cambiototalfis.classList.replace("text-success", "text-danger");
    } else {
        cambiototalfis.classList.replace("text-success", "text-success");
        cambiototalfis.classList.replace("text-danger", "text-success");
    }

    const cambio1g = document.getElementById("x_oneamtGerente_r");
    const cambio5g = document.getElementById("x_fiveamtGerente_r");
    const cambio10g = document.getElementById("x_tenamtGerente_r");
    const cambio20g = document.getElementById("x_twentyamtGerente_r");
    const cambio50g = document.getElementById("x_fiftyamtGerente_r");
    const cambio100g = document.getElementById("x_hundredamtGerente_r");
    const cambiototalger = document.getElementById("Gerente_t");
    if (document.getElementById("x_oneamtGerente_r").innerHTML <= -0.01) {
        cambio1g.classList.replace("text-success", "text-danger");
    } else {
        cambio1g.classList.replace("text-success", "text-success");
        cambio1g.classList.replace("text-danger", "text-success");
    }
    if (document.getElementById("x_fiveamtGerente_r").innerHTML <= -0.01) {
        cambio5g.classList.replace("text-success", "text-danger");
    } else {
        cambio5g.classList.replace("text-success", "text-success");
        cambio5g.classList.replace("text-danger", "text-success");
    }
    if (document.getElementById("x_tenamtGerente_r").innerHTML <= -0.01) {
        cambio10g.classList.replace("text-success", "text-danger");
    } else {
        cambio10g.classList.replace("text-success", "text-success");
        cambio10g.classList.replace("text-danger", "text-success");
    }
    if (document.getElementById("x_twentyamtGerente_r").innerHTML <= -0.01) {
        cambio20g.classList.replace("text-success", "text-danger");
    } else {
        cambio20g.classList.replace("text-success", "text-success");
        cambio20g.classList.replace("text-danger", "text-success");
    }
    if (document.getElementById("x_fiftyamtGerente_r").innerHTML <= -0.01) {
        cambio50g.classList.replace("text-success", "text-danger");
    } else {
        cambio50g.classList.replace("text-success", "text-success");
        cambio50g.classList.replace("text-danger", "text-success");
    }
    if (document.getElementById("x_hundredamtGerente_r").innerHTML <= -0.01) {
        cambio100g.classList.replace("text-success", "text-danger");
    } else {
        cambio100g.classList.replace("text-success", "text-success");
        cambio100g.classList.replace("text-danger", "text-success");
    }
    if (parseFloat(document.getElementById("Gerente_t").innerHTML) < parseFloat(document.getElementById(
        "Fiscalizadora_t").innerHTML)) {
        cambiototalger.classList.replace("text-success", "text-danger");
    } else {
        cambiototalger.classList.replace("text-success", "text-success");
        cambiototalger.classList.replace("text-danger", "text-success");
    }
    const cambioyappyFiscalizadora = document.getElementById("yappyFiscalizadora_r");
    const cambiootrosFiscalizadora = document.getElementById("otrosFiscalizadora_r");
    const cambiovalespagodaFiscalizadora = document.getElementById("valespagodaFiscalizadora_r");
    const cambioCheckAmtFiscalizadora = document.getElementById("CheckAmtFiscalizadora_r");
    const cambioLotoAmtFiscalizadora = document.getElementById("LotoAmtFiscalizadora_r");
    const cambiovaleAmtFiscalizadora = document.getElementById("valeAmtFiscalizadora_r");
    const cambioCardClaveFiscalizadora = document.getElementById("CardClaveFiscalizadora_r");
    const cambioCardValeFiscalizadora = document.getElementById("CardValeFiscalizadora_r");
    const cambioCardVisaFiscalizadora = document.getElementById("CardVisaFiscalizadora_r");
    const cambioCardMasterFiscalizadora = document.getElementById("CardMasterFiscalizadora_r");
    const cambioCardAEFiscalizadora = document.getElementById("CardAEFiscalizadora_r");
    const cambioCardBACFiscalizadora = document.getElementById("CardBACFiscalizadora_r");
    const cambioCashAmtFiscalizadora = document.getElementById("CashAmtFiscalizadora_r");
    const cambioCoinRollFiscalizadora = document.getElementById("CoinRollFiscalizadora_r");
    const cambioInvoiceAmtFiscalizadora = document.getElementById("InvoiceAmtFiscalizadora_r");
    const cambioInvoiceAmtPropiasFiscalizadora = document.getElementById("InvoiceAmtPropiasFiscalizadora_r");
    const cambioVoucherAmtFiscalizadora = document.getElementById("VoucherAmtFiscalizadora_r");
    const cambioGrantAmtFiscalizadora = document.getElementById("GrantAmtFiscalizadora_r");
    const cambioOtros_Fiscalizadora_t = document.getElementById("Otros_Fiscalizadora_t");
    const cambioMonto_contado_Fiscalizadora_t = document.getElementById("Monto_contado_Fiscalizadora");
    const cambioMonto_Fiscalizadora_t = document.getElementById("Monto_Fiscalizadora_t");

    if (document.getElementById("yappyFiscalizadora_r").innerHTML <= -0.01) {
        cambioyappyFiscalizadora.classList.replace("text-success", "text-danger");
    } else {
        cambioyappyFiscalizadora.classList.replace("text-success", "text-success");
        cambioyappyFiscalizadora.classList.replace("text-danger", "text-success");
    }
    if (document.getElementById("otrosFiscalizadora_r").innerHTML <= -0.01) {
        cambiootrosFiscalizadora.classList.replace("text-success", "text-danger");
    } else {
        cambiootrosFiscalizadora.classList.replace("text-success", "text-success");
        cambiootrosFiscalizadora.classList.replace("text-danger", "text-success");
    }
    if (document.getElementById("valespagodaFiscalizadora_r").innerHTML <= -0.01) {
        cambiovalespagodaFiscalizadora.classList.replace("text-success", "text-danger");
    } else {
        cambiovalespagodaFiscalizadora.classList.replace("text-success", "text-success");
        cambiovalespagodaFiscalizadora.classList.replace("text-danger", "text-success");
    }
    if (document.getElementById("CheckAmtFiscalizadora_r").innerHTML <= -0.01) {
        cambioCheckAmtFiscalizadora.classList.replace("text-success", "text-danger");
    } else {
        cambioCheckAmtFiscalizadora.classList.replace("text-success", "text-success");
        cambioCheckAmtFiscalizadora.classList.replace("text-danger", "text-success");
    }
    if (document.getElementById("LotoAmtFiscalizadora_r").innerHTML <= -0.01) {
        cambioLotoAmtFiscalizadora.classList.replace("text-success", "text-danger");
    } else {
        cambioLotoAmtFiscalizadora.classList.replace("text-success", "text-success");
        cambioLotoAmtFiscalizadora.classList.replace("text-danger", "text-success");
    }
    if (document.getElementById("CardClaveFiscalizadora_r").innerHTML <= -0.01) {
        cambioCardClaveFiscalizadora.classList.replace("text-success", "text-danger");
    } else {
        cambioCardClaveFiscalizadora.classList.replace("text-success", "text-success");
        cambioCardClaveFiscalizadora.classList.replace("text-danger", "text-success");
    }
    if (document.getElementById("CardValeFiscalizadora_r").innerHTML <= -0.01) {
        cambioCardValeFiscalizadora.classList.replace("text-success", "text-danger");
    } else {
        cambioCardValeFiscalizadora.classList.replace("text-success", "text-success");
        cambioCardValeFiscalizadora.classList.replace("text-danger", "text-success");
    }
    if (document.getElementById("CardVisaFiscalizadora_r").innerHTML <= -0.01) {
        cambioCardVisaFiscalizadora.classList.replace("text-white", "text-danger");
        cambioCardVisaFiscalizadora.classList.replace("text-success", "text-danger");
    } else {
        cambioCardVisaFiscalizadora.classList.replace("text-success", "text-success");
        cambioCardVisaFiscalizadora.classList.replace("text-danger", "text-success");
    }
    if (document.getElementById("CardMasterFiscalizadora_r").innerHTML <= -0.01) {
        cambioCardMasterFiscalizadora.classList.replace("text-success", "text-danger");
    } else {
        cambioCardMasterFiscalizadora.classList.replace("text-success", "text-success");
        cambioCardMasterFiscalizadora.classList.replace("text-danger", "text-success");
    }
    if (document.getElementById("CardAEFiscalizadora_r").innerHTML <= -0.01) {
        cambioCardAEFiscalizadora.classList.replace("text-success", "text-danger");
    } else {
        cambioCardAEFiscalizadora.classList.replace("text-success", "text-success");
        cambioCardAEFiscalizadora.classList.replace("text-danger", "text-success");
    }
    if (document.getElementById("CashAmtFiscalizadora_r").innerHTML <= -0.01) {
        cambioCashAmtFiscalizadora.classList.replace("text-success", "text-danger");
    } else {
        cambioCashAmtFiscalizadora.classList.replace("text-success", "text-success");
        cambioCashAmtFiscalizadora.classList.replace("text-danger", "text-success");
    }
    if (document.getElementById("CoinRollFiscalizadora_r").innerHTML <= -0.01) {
        cambioCoinRollFiscalizadora.classList.replace("text-success", "text-danger");
    } else {
        cambioCoinRollFiscalizadora.classList.replace("text-success", "text-success");
        cambioCoinRollFiscalizadora.classList.replace("text-danger", "text-success");
    }
    if (document.getElementById("InvoiceAmtFiscalizadora_r").innerHTML <= -0.01) {
        cambioInvoiceAmtFiscalizadora.classList.replace("text-success", "text-danger");
    } else {
        cambioInvoiceAmtFiscalizadora.classList.replace("text-success", "text-success");
        cambioInvoiceAmtFiscalizadora.classList.replace("text-danger", "text-success");
    }
    if (document.getElementById("VoucherAmtFiscalizadora_r").innerHTML <= -0.01) {
        cambioVoucherAmtFiscalizadora.classList.replace("text-success", "text-danger");
    } else {
        cambioVoucherAmtFiscalizadora.classList.replace("text-success", "text-success");
        cambioVoucherAmtFiscalizadora.classList.replace("text-danger", "text-success");
    }
    if (document.getElementById("GrantAmtFiscalizadora_r").innerHTML <= -0.01) {
        cambioGrantAmtFiscalizadora.classList.replace("text-success", "text-danger");
    } else {
        cambioGrantAmtFiscalizadora.classList.replace("text-success", "text-success");
        cambioGrantAmtFiscalizadora.classList.replace("text-danger", "text-success");
    }
    if (document.getElementById("valeAmtFiscalizadora_r").innerHTML <= -0.01) {
        cambiovaleAmtFiscalizadora.classList.replace("text-success", "text-danger");
    } else {
        cambiovaleAmtFiscalizadora.classList.replace("text-success", "text-success");
        cambiovaleAmtFiscalizadora.classList.replace("text-danger", "text-success");
    }
    if (parseFloat(document.getElementById("Otros_Fiscalizadora_t").innerHTML) < parseFloat(document.getElementById(
        "Otros").innerHTML)) {
        cambioOtros_Fiscalizadora_t.classList.replace("text-white", "text-danger");
        cambioOtros_Fiscalizadora_t.classList.replace("text-success", "text-danger");
    } else {
        cambioOtros_Fiscalizadora_t.classList.replace("text-success", "text-success");
        cambioOtros_Fiscalizadora_t.classList.replace("text-danger", "text-success");
    }
    if (parseFloat(document.getElementById("Monto_contado_Fiscalizadora").innerHTML) < parseFloat(document
        .getElementById("Monto_contado_Sistema").innerHTML)) {
        cambioMonto_contado_Fiscalizadora_t.classList.replace("text-white", "text-danger");
        cambioMonto_contado_Fiscalizadora_t.classList.replace("text-success", "text-danger");
    } else {
        cambioMonto_contado_Fiscalizadora_t.classList.replace("text-success", "text-success");
        cambioMonto_contado_Fiscalizadora_t.classList.replace("text-danger", "text-success");
    }
    if (parseFloat(document.getElementById("Monto_Fiscalizadora_t").innerHTML) < parseFloat(document.getElementById(
        "Monto_Subtotal_Sistema").innerHTML)) {
        cambioMonto_Fiscalizadora_t.classList.replace("text-success", "text-danger");
    } else {
        cambioMonto_Fiscalizadora_t.classList.replace("text-success", "text-success");
        cambioMonto_Fiscalizadora_t.classList.replace("text-danger", "text-success");
    }
    const cambioyappyGerente = document.getElementById("yappyGerente_r");
    const cambiootrosGerente = document.getElementById("otrosGerente_r");
    const cambiootrosprimeroGerente = document.getElementById("otrosprimeroGerente_r");
    const cambiovalespagodaGerente = document.getElementById("valespagodaGerente_r");
    const cambioCheckAmtGerente = document.getElementById("CheckAmtGerente_r");
    const cambioLotoAmtGerente = document.getElementById("LotoAmtGerente_r");
    const cambiovaleAmtGerente = document.getElementById("valeAmtGerente_r");
    const cambioCardClaveGerente = document.getElementById("CardClaveGerente_r");
    const cambioCardValeGerente = document.getElementById("CardValeGerente_r");
    const cambioCardVisaGerente = document.getElementById("CardVisaGerente_r");
    const cambioCardMasterGerente = document.getElementById("CardMasterGerente_r");
    const cambioCardAEGerente = document.getElementById("CardAEGerente_r");
    const cambioCardBACGerente = document.getElementById("CardBACGerente_r");
    const cambioCashAmtGerente = document.getElementById("CashAmtGerente_r");
    const cambioCoinRollGerente = document.getElementById("CoinRollGerente_r");
    const cambioInvoiceAmtGerente = document.getElementById("InvoiceAmtGerente_r");
    const cambioInvoiceAmtPropiasGerente = document.getElementById("InvoiceAmtPropiasGerente_r");
    const cambioVoucherAmtGerente = document.getElementById("VoucherAmtGerente_r");
    const cambioGrantAmtGerente = document.getElementById("GrantAmtGerente_r");
    const cambioMonto_contado_Gerente = document.getElementById("Monto_contado_Gerente");
    const cambioMonto_Gerente_t = document.getElementById("Monto_Gerente_t");
    const cambioOtros_Gerente_t = document.getElementById("Otros_Gerente_t");

    if (document.getElementById("yappyGerente_r").innerHTML <= -0.01) {
        cambioyappyGerente.classList.replace("text-success", "text-danger");
    } else {
        cambioyappyGerente.classList.replace("text-success", "text-success");
        cambioyappyGerente.classList.replace("text-danger", "text-success");
    }
    if (document.getElementById("otrosGerente_r").innerHTML <= -0.01) {
        cambiootrosGerente.classList.replace("text-success", "text-danger");
    } else {
        cambiootrosGerente.classList.replace("text-success", "text-success");
        cambiootrosGerente.classList.replace("text-danger", "text-success");
    }
    //otros
    if (document.getElementById("otrosprimeroGerente_r").innerHTML <= -0.01) {
        cambiootrosprimeroGerente.classList.replace("text-success", "text-danger");
    } else {
        cambiootrosprimeroGerente.classList.replace("text-success", "text-success");
        cambiootrosprimeroGerente.classList.replace("text-danger", "text-success");
    }
    //
    if (document.getElementById("valespagodaGerente_r").innerHTML <= -0.01) {
        cambiovalespagodaGerente.classList.replace("text-success", "text-danger");
    } else {
        cambiovalespagodaGerente.classList.replace("text-success", "text-success");
        cambiovalespagodaGerente.classList.replace("text-danger", "text-success");
    }
    if (document.getElementById("CheckAmtGerente_r").innerHTML <= -0.01) {
        cambioCheckAmtGerente.classList.replace("text-success", "text-danger");
    } else {
        cambioCheckAmtGerente.classList.replace("text-success", "text-success");
        cambioCheckAmtGerente.classList.replace("text-danger", "text-success");
    }
    if (document.getElementById("LotoAmtGerente_r").innerHTML <= -0.01) {
        cambioLotoAmtGerente.classList.replace("text-success", "text-danger");
    } else {
        cambioLotoAmtGerente.classList.replace("text-success", "text-success");
        cambioLotoAmtGerente.classList.replace("text-danger", "text-success");
    }
    ///tarjetas
    if (document.getElementById("CardClaveGerente_r").innerHTML <= -0.01) {
        cambioCardClaveGerente.classList.replace("text-success", "text-danger");
    } else {
        cambioCardClaveGerente.classList.replace("text-success", "text-success");
        cambioCardClaveGerente.classList.replace("text-danger", "text-success");
    }
    if (document.getElementById("CardValeGerente_r").innerHTML <= -0.01) {
        cambioCardValeGerente.classList.replace("text-success", "text-danger");
    } else {
        cambioCardValeGerente.classList.replace("text-success", "text-success");
        cambioCardValeGerente.classList.replace("text-danger", "text-success");
    }
    if (document.getElementById("CardVisaGerente_r").innerHTML <= -0.01) {
        cambioCardVisaGerente.classList.replace("text-success", "text-danger");
    } else {
        cambioCardVisaGerente.classList.replace("text-success", "text-success");
        cambioCardVisaGerente.classList.replace("text-danger", "text-success");
    }
    if (document.getElementById("CardMasterGerente_r").innerHTML <= -0.01) {
        cambioCardMasterGerente.classList.replace("text-success", "text-danger");
    } else {
        cambioCardMasterGerente.classList.replace("text-success", "text-success");
        cambioCardMasterGerente.classList.replace("text-danger", "text-success");
    }
    if (document.getElementById("CardAEGerente_r").innerHTML <= -0.01) {
        cambioCardAEGerente.classList.replace("text-success", "text-danger");
    } else {
        cambioCardAEGerente.classList.replace("text-success", "text-success");
        cambioCardAEGerente.classList.replace("text-danger", "text-success");
    }
    if (document.getElementById("CardBACGerente_r").innerHTML <= -0.01) {
        cambioCardBACGerente.classList.replace("text-success", "text-danger");
    } else {
        cambioCardBACGerente.classList.replace("text-success", "text-success");
        cambioCardBACGerente.classList.replace("text-danger", "text-success");
    }
    ///
    if (document.getElementById("CashAmtGerente_r").innerHTML <= -0.01) {
        cambioCashAmtGerente.classList.replace("text-success", "text-danger");
    } else {
        cambioCashAmtGerente.classList.replace("text-success", "text-success");
        cambioCashAmtGerente.classList.replace("text-danger", "text-success");
    }
    if (document.getElementById("CoinRollGerente_r").innerHTML <= -0.01) {
        cambioCoinRollGerente.classList.replace("text-success", "text-danger");
    } else {
        cambioCoinRollGerente.classList.replace("text-success", "text-success");
        cambioCoinRollGerente.classList.replace("text-danger", "text-success");
    }
    if (document.getElementById("InvoiceAmtGerente_r").innerHTML <= -0.01) {
        cambioInvoiceAmtGerente.classList.replace("text-success", "text-danger");
    } else {
        cambioInvoiceAmtGerente.classList.replace("text-success", "text-success");
        cambioInvoiceAmtGerente.classList.replace("text-danger", "text-success");
    }
    if (document.getElementById("VoucherAmtGerente_r").innerHTML <= -0.01) {
        cambioVoucherAmtGerente.classList.replace("text-success", "text-danger");
    } else {
        cambioVoucherAmtGerente.classList.replace("text-success", "text-success");
        cambioVoucherAmtGerente.classList.replace("text-danger", "text-success");
    }
    if (document.getElementById("GrantAmtGerente_r").innerHTML <= -0.01) {
        cambioGrantAmtGerente.classList.replace("text-success", "text-danger");
    } else {
        cambioGrantAmtGerente.classList.replace("text-success", "text-success");
        cambioGrantAmtGerente.classList.replace("text-danger", "text-success");
    }
    if (document.getElementById("valeAmtGerente_r").innerHTML <= -0.01) {
        cambiovaleAmtGerente.classList.replace("text-success", "text-danger");
    } else {
        cambiovaleAmtGerente.classList.replace("text-success", "text-success");
        cambiovaleAmtGerente.classList.replace("text-danger", "text-success");
    }
    if (document.getElementById("InvoiceAmtPropiasGerente_r").innerHTML <= -0.01) {
        cambioInvoiceAmtPropiasGerente.classList.replace("text-success", "text-danger");
    } else {
        cambioInvoiceAmtPropiasGerente.classList.replace("text-success", "text-success");
        cambioInvoiceAmtPropiasGerente.classList.replace("text-danger", "text-success");
    }
    if (parseFloat(document.getElementById("Monto_contado_Gerente").innerHTML) < parseFloat(document.getElementById(
        "Monto_contado_Fiscalizadora").innerHTML)) {
        cambioMonto_contado_Gerente.classList.replace("text-success", "text-danger");
    } else {
        cambioMonto_contado_Gerente.classList.replace("text-success", "text-success");
        cambioMonto_contado_Gerente.classList.replace("text-danger", "text-success");
    }
    if (parseFloat(document.getElementById("Monto_Gerente_t").innerHTML) < parseFloat(document.getElementById(
        "Monto_Fiscalizadora_t").innerHTML)) {
        cambioMonto_Gerente_t.classList.replace("text-success", "text-danger");
    } else {
        cambioMonto_Gerente_t.classList.replace("text-success", "text-success");
        cambioMonto_Gerente_t.classList.replace("text-danger", "text-success");
    }
    if (document.getElementById("Otros_Gerente_t").innerHTML < document.getElementById("Otros_Fiscalizadora_t")
        .innerHTML) {
        cambioOtros_Gerente_t.classList.replace("text-success", "text-danger");
    } else {
        cambioOtros_Gerente_t.classList.replace("text-success", "text-success");
        cambioOtros_Gerente_t.classList.replace("text-danger", "text-success");
    }
}

function clon() {
    document.closecash_store.x_oneamtGerente.value = document.closecash_store.x_oneamtFiscalizadora.value;
    document.closecash_store.x_fiveamtGerente.value = document.closecash_store.x_fiveamtFiscalizadora.value;
    document.closecash_store.x_tenamtGerente.value = document.closecash_store.x_tenamtFiscalizadora.value;
    document.closecash_store.x_twentyamtGerente.value = document.closecash_store.x_twentyamtFiscalizadora.value;
    document.closecash_store.x_fiftyamtGerente.value = document.closecash_store.x_fiftyamtFiscalizadora.value;
    document.closecash_store.x_hundredamtGerente.value = document.closecash_store.x_hundredamtFiscalizadora.value;
    document.closecash_store.yappyGerente.value = document.closecash_store.yappyFiscalizadora.value;
    document.closecash_store.otrosGerente.value = document.closecash_store.otrosFiscalizadora.value;
    document.closecash_store.otrosprimeroGerente.value = document.closecash_store.otrosprimeroFiscalizadora.value;
    document.closecash_store.valespagodaGerente.value = document.closecash_store.valespagodaFiscalizadora.value;
    document.closecash_store.CheckAmtGerente.value = document.closecash_store.CheckAmtFiscalizadora.value;
    document.closecash_store.LotoAmtGerente.value = document.closecash_store.LotoAmtFiscalizadora.value;
    document.closecash_store.valeAmtGerente.value = document.closecash_store.valeAmtFiscalizadora.value;
    document.closecash_store.CardClaveGerente.value = document.closecash_store.CardClaveFiscalizadora.value;
    document.closecash_store.CardValeGerente.value = document.closecash_store.CardValeFiscalizadora.value;
    document.closecash_store.CardVisaGerente.value = document.closecash_store.CardVisaFiscalizadora.value;
    document.closecash_store.CardMasterGerente.value = document.closecash_store.CardMasterFiscalizadora.value;
    document.closecash_store.CardAEGerente.value = document.closecash_store.CardAEFiscalizadora.value;
    document.closecash_store.CardBACGerente.value = document.closecash_store.CardBACFiscalizadora.value;
    document.closecash_store.CashAmtGerente.value = document.closecash_store.CashAmtFiscalizadora.value;
    document.closecash_store.CoinRollGerente.value = document.closecash_store.CoinRollFiscalizadora.value;
    document.closecash_store.InvoiceAmtGerente.value = document.closecash_store.InvoiceAmtFiscalizadora.value;
    document.closecash_store.InvoiceAmtPropiasGerente.value = document.closecash_store.InvoiceAmtPropiasFiscalizadora.value;
    document.closecash_store.VoucherAmtGerente.value = document.closecash_store.VoucherAmtFiscalizadora.value;
    document.closecash_store.GrantAmtGerente.value = document.closecash_store.GrantAmtFiscalizadora.value;
}
function zero() {
}