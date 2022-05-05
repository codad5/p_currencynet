import { currencySet, countryset } from './production-assets'

class currencynet {
        /**
         * @param floatBol
         * When set to true it makes all the currency value a `float data type`
         * the float data type is in 2 decimal places
         */
    constructor(floatBol = true) {
        
        this.floatBol = floatBol;
    
        this.mainClass = document.querySelectorAll('.currencynet-init');
        this.buildCurrency = "USD";
        this.clientCurrency = "USD".toUpperCase();
        this.countryCode = ["AFA", "ALL", "DZD", "AOA", "ARS", "AMD", "AWG", "AUD", "AZN", "BSD", "BHD", "BDT", "BBD", "BYR", "BEF", "BZD", "BMD", "BTN", "BTC", "BOB", "BAM", "BWP", "BRL", "GBP", "BND", "BGN", "BIF", "KHR", "CAD", "CVE", "KYD", "XOF", "XAF", "XPF", "CLP", "CNY", "COP", "KMF", "CDF", "CRC", "HRK", "CUC", "CZK", "DKK", "DJF", "DOP", "XCD", "EGP", "ERN", "EEK", "ETB", "EUR", "FKP", "FJD", "GMD", "GEL", "DEM", "GHS", "GIP", "GRD", "GTQ", "GNF", "GYD", "HTG", "HNL", "HKD", "HUF", "ISK", "INR", "IDR", "IRR", "IQD", "ILS", "ITL", "JMD", "JPY", "JOD", "KZT", "KES", "KWD", "KGS", "LAK", "LVL", "LBP", "LSL", "LRD", "LYD", "LTL", "MOP", "MKD", "MGA", "MWK", "MYR", "MVR", "MRO", "MUR", "MXN", "MDL", "MNT", "MAD", "MZM", "MMK", "NAD", "NPR", "ANG", "TWD", "NZD", "NIO", "NGN", "KPW", "NOK", "OMR", "PKR", "PAB", "PGK", "PYG", "PEN", "PHP", "PLN", "QAR", "RON", "RUB", "RWF", "SVC", "WST", "SAR", "RSD", "SCR", "SLL", "SGD", "SKK", "SBD", "SOS", "ZAR", "KRW", "XDR", "LKR", "SHP", "SDG", "SRD", "SZL", "SEK", "CHF", "SYP", "STD", "TJS", "TZS", "THB", "TOP", "TTD", "TND", "TRY", "TMT", "UGX", "UAH", "AED", "UYU", "USD", "UZS", "VUV", "VEF", "VND", "YER", "ZMK"];
        this.clientCurrencyLogo = currencySet[this.clientCurrency].symbol;
        this.url = `http://localhost/currencynet/`;
        this.endpoint = this.url + `api/?url=` + window.location.origin+"/currencynet/";

        this.defaultRate = 1;
        /**
         * this is to store the data of the particular website
         * The json object carrys both the build currrency of the website 
         * @return json
         */
        this.data = fetch(this.endpoint)
            .then(function (response) {
                return response.json();
            })
            .then(function (jsonData) {
                // console.log(jsonData);
                // console.log(jsonData.data);
                return jsonData;
            });
            /**
             * This method is called to fetvh the user Location object
             * if successful the promise contains both logitude and latitude coords
             * @return Promise
             * 
             */
        this.awaitLocation = () => {
            navigator.geolocation.getCurrentPosition((position) => {
                // var position = 3;
                latitude = position.coords.latitude;
                longitude = position.coords.longitude;
                console.log(position);
                return new Promise(resolve => { resolve(position.coords); });
                // console.log(position.coords);
            });
        };
        /**
         * This method is called to fetvh the user Location object
         * if successful the promise contains both logitude and latitude coords
         * @return Promise
         * 
         */
        this.getCurrentPosition = () => {
            let locationTimeout = () => setTimeout(() => {
                console.log("Location TimeOUt");
                return new Promise(resolve => { resolve(null); });
            }, 3000);
            return new Promise((resolve, reject) => {
                navigator.geolocation.getCurrentPosition(
                    // locationTimeout(),
                    position => resolve(position),
                    // clearTimeout(locationTimeout),
                    error => reject(error)
                );
            });
        };
        /**
             * Thism convert the build currency to client currency
             * 
             * @param {Integer} amount
             * This is the amount in the buid currency to be converted to client currency
             * 
             * @param {string} buildCurrency
             * This is a short hand form of the application currency its length is 3 max
             * 
             * 
             * 
             * @return {Integer} amount
             * This property returns the amount in the client currency
             * 
             */
        this.convert = (amount = 0, buildCurrency = this.buildCurrency) => {

            let clientCurrency = this.clientCurrency;
            let rate = this.defaultRate;
            if (buildCurrency !== this.buildCurrency) {
                let rateKey = `https://free.currconv.com/api/v7/convert?q=${buildCurrency}_${this.clientCurrency}&compact=ultra&apiKey=33e6a9fae58c3301bf76`;

                let rateData = fetch(rateKey)
                    .then(function (response) {
                        return response.json();
                    })
                    .then(function (jsonData) {
                        // console.log(jsonData);
                        return jsonData;




                        // this.editCurrencyTag(countryCode);
                    }).catch((e) => {
                        return e;
                    });
                rate = rateData[`${buildCurrency}_${this.clientCurrency}`];
            }

            console.log(clientCurrency);
            if (!this.floatBol) {


                return parseInt(amount * this.defaultRate);
            }
            else {
                return amount * rate;
            }


        };
        /**
         * This method fetch the client location information
         * @param {JSON} coords 
         * This is the json representation of the client browser coordinates
         * @return {JSON} client
         * This JSON contains informaton about the client location
         */
        this.fetchCountry = (coords) => {
            let lat = coords.latitude;
            let long = coords.longitude;
            fetch("https://api.opencagedata.com/geocode/v1/json?q=" + lat + "+" + long + "&key=7db17f144fc245e791ef803d44afa6ee&pretty=1")
                .then(function (response) {
                    return response.json();
                })
                .then(function (jsonData) {
                    // console.log(jsonData);
                    // console.log(jsonData.data);
                    // console.log(jsonData);
                    return jsonData;
                });
        };
        /**
         * 
         * @param {HTML DOM ELEMENT} elem 
         * This is an array of the target elements in which it want to get its classes from
         * @param {STRING} defaultclass 
         * 
         * @returns {String} list
         * This return a string which contains all the classes of the targeted element in the String    
         */
        this.getClassList = (elem, defaultclass = "usd") => {
            let list = "";
            const pattern = 'currencynet-init';
            let num = 0, subDeafult = pattern + '-' + defaultclass.toLowerCase();

            Array.prototype.forEach.call(elem.classList, element => {
                if (element !== pattern && element !== subDeafult) {
                    num++;
                    console.log(subDeafult);
                    // console.log(element);
                    list += "\n " + num + "->" + element + "\n";
                }
            });
            // console.log(defaultclass);
            return list;
        };

        /**
         * 
         * This modify all the element with currencNet classes aside the main `general class` (`currencynet-init`)
         * @param {String} countryCode 
         * This the shorthand for the client country code
         * @param {bool} bol 
         * When set `true` it set the currency to that of the client country
         * else set the currency to that of the application build currency
         * 
         @return {void}
         */
        this.editCurrencyTag = (countryCode = this.countryCode, bol = true) => {
            this.clientCurrencyLogo = currencySet[this.clientCurrency].symbol;

            Array.prototype.forEach.call(countryCode, element => {
                let currency = element;
                let symbol = currencySet[currency].symbol;
                Array.prototype.forEach.call(document.querySelectorAll('.currencynet-init-' + element.toLowerCase()), async (element) => {
                    let priceValue = 0;
                    if ((Number(element.dataset.currencynetValue) > 0 && Number(element.dataset['currencynet-value']) != NaN) || (Number(element.innerHTML) > 0 && Number(element.innerHTML) != NaN)) {

                        let fallback = Number(element.innerHTML) ?? 0;
                        priceValue = Number(element.dataset.currencynetValue) ?? fallback;
                        console.log(priceValue);
                        if (bol) {
                            let rateData = await this.getDefaultRate(currency);
                            console.log(rateData);
                            let rate = rateData[`${currency}_${this.clientCurrency}`];
                            // let showValue = this.convert(priceValue, currency);
                            if (rate == NaN || rate == null || rate == undefined) {

                                element.innerHTML = symbol + priceValue;
                            } else {

                                element.innerHTML = this.clientCurrencyLogo + (rate * priceValue);
                            }
                        } else {
                            element.innerHTML = symbol + priceValue;


                        }
                    } else {
                        console.warn(`Element with class List \n ${this.getClassList(element, currency)} \n Element error : Expected an integer was given a string ( "${element.dataset.currencynetValue}" )`);

                    }

                });
            });
        };
        /**
         * This modify all the element with class `currency-net-init`, it edit all their innerHtml to that of the curresponding currency conversion output
         * 
         * 
         * @param {NodeListOf<Element>} mainClass  
         * This is an array list if all the elemnt with the className `currencynet-init`
         * 
         *  
         * @param {*} bol
         * When set `true` it set the currency to that of the client country
         * else set the currency to that of the application build currency
         *  
         */
        this.editNormTag = (mainClass = this.mainClass, bol = true) => {
            this.clientCurrencyLogo = currencySet[this.clientCurrency].symbol;

            let buildCurrencyLogo = currencySet[this.buildCurrency].symbol;

            Array.prototype.forEach.call(mainClass, element => {

                let priceValue = 0;
                if ((Number(element.dataset.currencynetValue) > 0 && Number(element.dataset['currencynet-value']) != NaN) || (Number(element.innerHTML) > 0 && Number(element.innerHTML) != NaN)) {
                    let fallback = Number(element.innerHTML) ?? 0;
                    priceValue = Number(element.dataset.currencynetValue) ?? fallback;
                    console.log('hello' + this.clientCurrencyLogo);

                    if (bol) {


                        element.innerHTML = this.clientCurrencyLogo + this.convert(priceValue);


                    } else {

                        element.innerHTML = buildCurrencyLogo + priceValue;
                    }
                }
                else {
                    console.warn(`Element with class List \n ${this.getClassList(element)} \n , and Id = ${element.id} Element error : Expected an integer was given a string ( "${element.dataset.currencynetValue}" )`);
                }
                // console.log(position);
            });
            // return 20+"me";
        };
        /**
         * This return a json data of the clients currency  details 
         * 
         * @param {String} newpoint 
         * This is the api connectiion url to get the details about the client currency
         * 
         * @returns {JSON} json 
         * This json contains the details of the currency conversion
         */
        this.getCurrencyDetails = (newpoint) => {
            return fetch(newpoint)
                .then(function (response) {
                    return response.json();
                })
                .then(function (jsonData) {
                    // console.log(jsonData);
                    return jsonData;




                    // this.editCurrencyTag(countryCode);
                }).catch((e) => {
                    return e;
                });
        };
        this.getDefaultRate = (buildCurrency = this.buildCurrency) => {
            let rateKey = `https://free.currconv.com/api/v7/convert?q=${buildCurrency}_${this.clientCurrency}&compact=ultra&apiKey=a6d05172b2432094770f`;

            return fetch(rateKey)
                .then(function (response) {
                    return response.json();
                })
                .then(function (jsonData) {
                    // console.log(jsonData);
                    return jsonData;




                    // this.editCurrencyTag(countryCode);
                }).catch((e) => {
                    return e;
                });
        };
        this.reWrite = async (manualEdit = false) => {
            // await this.data;
            // console.log(this.mainClass);
            let countryCode = this.countryCode;
            let mainClass = this.mainClass;
            // let
            // let editNormTag = () => this.editNormTag(mainClass);
            // let editCurrencyTag = () => this.editCurrencyTag(mainClass);
            let primaryCurrency = 'USD';
            let data = await this.data;
            // console.log(data);
            if (data.status) {
                if (data.error == null) {
                    let website_currency = data.data.website_currency.toUpperCase();
                    this.buildCurrency = website_currency;
                    if (manualEdit === false) {
                        this.clientCurrency = website_currency;

                    }

                    this.clientCurrencyLogo = currencySet[this.clientCurrency].symbol;
                    console.log("meme" + this.clientCurrencyLogo);


                    this.editNormTag(mainClass, false);

                    this.editCurrencyTag(countryCode, false);
                    if (navigator.geolocation) {
                        try {
                            if (manualEdit == false) {
                            const position = await this.getCurrentPosition();
                            console.log(position);
                            let lat = position.coords.latitude;
                            let lon = position.coords.longitude;
                            // var editNormTags = this.editNormTag(countryCode);
                            console.log(lon);
                            console.log(lat);
                            console.log("hello manual edit = false");
                                console.log("hello manual edit = false");

                                let newpoint = "https://api.opencagedata.com/geocode/v1/json?q=" + lat + "+" + lon + "&key=7db17f144fc245e791ef803d44afa6ee&pretty=1";
                                console.log("checking::" + this.editNormTag(mainClass));
                                currencyDetails = await this.getCurrencyDetails(newpoint);
                                // console.log(currencyDetails);
                                const userLocation = currencyDetails;
                                console.log(userLocation);


                                // });
                                // console.log(countryset);
                                console.log("bite " + userLocation.results[0].components['ISO_3166-1_alpha-2']);
                                let ISO_3166 = userLocation.results[0].components['ISO_3166-1_alpha-2'];
                                this.clientCurrency = countryset[ISO_3166].currency;
                            }
                            this.clientCurrencyLogo = currencySet[this.clientCurrency].symbol;
                            let rateData = await this.getDefaultRate();
                            console.log(rateData);
                            this.defaultRate = rateData[`${this.buildCurrency}_${this.clientCurrency}`];
                            if (this.defaultRate == NaN || this.defaultRate == undefined) {

                                this.editNormTag(mainClass, false);
                                this.editCurrencyTag(countryCode, false);
                            }
                            else {
                                this.editNormTag(mainClass);
                                this.editCurrencyTag(countryCode);

                            }
                            // "Access Restricted - Your current Subscription Plan does not support this API Function."
                            // console.log(userLocation.results[0].components['ISO_3166-1_alpha-2']);
                            // this.editNormTag(mainClass, true);
                            console.log("did this");
                            // await 
                        } catch (err) {

                            console.log("error fetching Client Location");
                            this.editNormTag(mainClass, false);
                            this.editCurrencyTag(countryCode, false);

                            // document.querySelector('p:nth-of-type(1)').innerText = err.message
                        }
                    }
                    else {
                        this.editNormTag(mainClass, false);

                        this.editCurrencyTag(countryCode, false);

                    }
                } else {
                    console.log(data);

                    console.log("request exceeded");
                }
            } else {
                console.log(`Fails to convert \n Webaite not registered error message = '${data.error}' login to ${this.url} to register your property`);
                console.log(data);
                console.log(this.endpoint);
            }

        };

    }
    
}

window.addEventListener("load", async () => {
    const currencyChange = new currencynet(false);
    await currencyChange.reWrite();
    

});


