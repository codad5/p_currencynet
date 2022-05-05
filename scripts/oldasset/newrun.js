
             $(document).ready(function () {
                 function payWithPaystack() {

                    console.log("hello payWithPaystack");
                // e.preventDefault();
                let handler = PaystackPop.setup({
                    key: "pk_live_4125c5662d4f3ce1a758fc0233bb746bd0dea5a3", // Replace with your public key
                    email: "aniezeoformic@gmail.com",
                    amount: 1000 * 1 * 100,
                    currency: "NGN",
                    ref: "kwn37db0r5",
                    
                    onClose: function(){
                    alert("Window closed.");
                    },
                    
                    callback: function(response) {
                        let message = "Payment complete! Reference: " + response.reference +"Keep the refrence for safe purpose";
                        alert(message);
                         $(".myPropTable").load("inc/addRequest.inc.php", {
                            refrence: response.reference
                            
                            

                        });
                        
                    }
                });
                handler.openIframe();
            }
            payWithPaystack();
            
        });

            