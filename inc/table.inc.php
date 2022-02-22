<div class="table-con" style="width:100%;overflow-y:scroll;padding:100px 0;">

    <table class="table table-striped table-hover table-responsive">
        <thead>
            <tr>
                <th>No</th>
            <th>Website</th>
            <th>TLD</th>
            <th>Currency</th>
            <th>total request</th>
            <th>total made</th>
            <th>avaliable request</th>
            
        </tr>
    </thead>
    <tbody>
        
    
        
        <?php 
             $websites = $user->getWebsites();
             //  var_dump($websites);
             $no = 0;
             if ($websites !== true) {
                 foreach ($websites as $website) {
                     $no++;
                     echo '<tr>
                     <th scope="row"> '.$no.' </th>
                            <td> '.$website['website_domain']. '</td>
                            <td>'.$website['website_TLD']. '</td>
                            <td>'.$website['website_currency']. '</td>
                            <td>'.$website['request_total'].'</td>
                            <td>'.$website['request_made']. '</td>
                            <td>'.$website['request_total'] - $website['request_made']. '</td>
                            <td><a class="btn btn-primary btn-sm btn-danger trash-btn"  role="button" data-url="'.$website['website_domain'].'">TRASH</a></td>
                            </tr>';
                 } ?>
                        </tbody>
    </table>
    
</div>
    <form action="inc/addRequest.inc.php" method="post" id='orderRequestForm'>
        <select name="url" id="orderWebsite">
            <?php
            foreach ($websites as $website) {
                echo '
                            
                            <option value='.$website['website_domain']. '> '.$website['website_domain']. '</option>
                            
                        ';
            }
            echo '</select>
                    <input type="number" name="amout" id="requestAmount" min="100" value="100">
                <button type="submit">Order at </button>';
             }
             ?>
             
        
    </form>
    <form  method="post"  id='verify-payment-form'>
        Verify Payment
        <input type="text" name="ref" id="ref_key">
        <button type="submit">Verfiy</button>
    </form>
    <script>
         $(document).ready(function () {
             let trashBtn = document.querySelectorAll('.trash-btn');
             Array.prototype.forEach.call(trashBtn, element => {
                //  console.log('me');
                 element.addEventListener('click', () => {
                     let url = element.dataset.url;
                     if(confirm('Are you sure you want to delete this item deleting it will reset the item all current request, data and settings will be lost?')){

                         $(".myPropTable").load("inc/verifywebsite.inc.php", {
                        website_url: url
                        
                        
                    });
                }

                 });
             });

             $("#orderRequestForm").submit(function (event) {
            event.preventDefault();
            let website = $("#orderWebsite").val();
            let amount = $("#requestAmount").val() ?? 0;
            console.log(website);
            if(confirm('Are you sure you want to make this request')){
                 $(".myPropTable").load("inc/addRequest.inc.php", {
                website: website,
                amount: amount
                

            });
            }
            



           
        });
             $("#verify-payment-form").submit(function (event) {
            event.preventDefault();
            let ref_key = $("#ref_key").val();
            
            
            
                 $(".myPropTable").load("inc/addRequest.inc.php", {
                ref_key: ref_key
                

            });
            
            



           
        });
           
        });
    </script>

