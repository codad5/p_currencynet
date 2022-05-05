// studentDetails.innerHTML = "";
window.addEventListener('load', () => {
    let latitude = "";
    let longitude = "";
    let countryCode = ['USD', 'NGN', "EUR"];
    let mainClass = document.querySelectorAll('.currencynet-init');
    let primaryCurrency = 'USD';
    let endpoint = `http://localhost/currencynet/api/?url=` + window.location.origin + "/Mayorkun/";
    // endpoint = `https://api.unsplash.com/search/photos?page=1&query=${Title}&client_id=${clientId}&order_by=relevant`;
    console.log(endpoint);
    // console.log(window.navigator.onLine);
    // checkStaus();
     fetch(endpoint)
        .then(function (response) {
            return response.json();
        })
        .then(function (jsonData) {
            console.log(jsonData);
            // console.log(jsonData.data);
            let data = jsonData;
            // console.log(data.data.website_currency);


            // for (const key in data) {
            //     if (Object.hasOwnProperty.call(data, key)) {
            //         let para = document.createElement("p");
            //         let stuentName = document.createElement("div");
            //         let age = document.createElement("span");
            //         const element = data[key];
            //         console.log(element);
            //         // document.createTextNode(` Name : ${element.name}`)
            //         stuentName.appendChild(document.createTextNode(` Name : ${element.name}
            //         `+ window.location.hostname));
            //         age.appendChild(document.createTextNode(` age : ${element.age}`));
            //         para.appendChild(stuentName);
            //         para.appendChild(age);
            //         studentDetails.appendChild(para);
            //     }
            // }


            // });
            if (data.status) {
                let website_currency = data.data.website_currency.toUpperCase();
                if (navigator.geolocation) {
                    var me = "hello";

                    navigator.geolocation.getCurrentPosition((position) => {
                         var position = 3;
                         latitude = position.coords.latitude; 
                         longitude = position.coords.longitude; 
                        console.log(longitude);
                    });
                    // console.log(position);
                    Array.prototype.forEach.call(mainClass, element => {
                        let priceValue = 0;
                        if ((Number(element.dataset.currencynetValue) > 0 && Number(element.dataset['currencynet-value']) != NaN) || (Number(element.innerHTML) > 0 && Number(element.innerHTML) != NaN)) {
                            let fallback = Number(element.innerHTML) ?? 0;
                            priceValue = Number(element.dataset.currencynetValue) ?? fallback;
                        } 
                        // console.log(position);
                        element.innerHTML = convert(website_currency);
                    });
                    Array.prototype.forEach.call(countryCode, element => {
                        let currency = element;
                        Array.prototype.forEach.call(document.querySelectorAll('.currencynet-init-' + element.toLowerCase()), element => {
                            let priceValue = 0;
                            if ((Number(element.dataset.currencynetValue) > 0 && Number(element.dataset['currencynet-value']) != NaN) || (Number(element.innerHTML) > 0 && Number(element.innerHTML) != NaN)) {

                                let fallback = Number(element.innerHTML) ?? 0;
                                priceValue = Number(element.dataset.currencynetValue) ?? fallback;
                            } 
                            console.log(priceValue);
                            element.innerHTML = website_currency + " " + (convert(currency) * priceValue);
                        });
                    });
                } else {

                }
            } else {
                Array.prototype.forEach.call(mainClass, element => {
                    let priceValue = 0;
                    if (Number(element.dataset.currencynetValue) > 0 && Number(element.dataset['currencynet-value']) != NaN) {

                        priceValue = Number(element.dataset.currencynetValue);
                    }
                    console.log(priceValue);
                    element.innerHTML = priceValue;
                });

            }
        });

    function convert(currency = 'USD', amount = 0) {
        console.log(currency);
        return 30;
    }

    async function getPosition(position) {
        document.write(position);
        // longitude = position.coords.longitude;
        // latitude = position.coords.latitude;

    }


});