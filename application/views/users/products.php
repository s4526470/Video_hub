<div style="width: 600px; height: 400px; margin: 0 auto; border-style: solid; border-color: lightcoral;">
    <!-- List all products -->
    <?php if(!empty($products)){ foreach($products as $row){ ?>
        <div>
            <h1 style="text-align: center; margin-top: 50px;"><?php echo $row['name']; ?></h1>
            <h3 style="text-align: center;">Price: <?php echo $row['price']; ?> USD</h3>
            <h3 style="margin-left: 110px; margin-top: 50px;">After buy it: </h3>
            <div style="margin-left: 130px;">
                <ul style="list-style-type: decimal; font-size: 1.2em; font-weight: bold;">
                    <li>You can watch more paid videos.</li>
                    <li>You can upload more videos.</li>
                    <li>You can download videos.</li>
                </ul>
            </div>
            <h3 style="text-align: center;">
                <a href="<?php echo base_url('vip/buy/'.$row['id']); ?>"
                    style="text-decoration: none; font-size: 1.5em; border-style: solid; border-color: lightblue;">
                    Purchase it!
                </a>
            </h3>
        </div>
    <?php } }else{ ?>
        <p>Product(s) not found...</p>
    <?php } ?>
</div>

