<?php
include "../include/db.php";

include "../include/authenticate.php"; 

if (getval("purchaseonaccount","")!="" && $userrequestmode==3 && enforcePostRequest(false))
	{
	# Invoice Mode
	# Note that terms basket and collection are interchangeable in this context

	# At this point the user collection is the basket which contains the resources just purchased
	$paidcollection=$usercollection;

	# Mark the payment flags for each resource in the basket as 'paid' and rename it to datetime format
	payment_set_complete($paidcollection);
	
	# Setup a new user collection which will be the new empty basket 
	$newcollection=create_collection($userref,"Default Collection",0,1); # 0=allowchanges 1=preventdelete
	set_user_collection($userref,$newcollection);
	
	# Redirect to the paid basket for the purpose of downloading
	redirect($baseurl_short."pages/purchase_download.php?collection=" . $paidcollection);
	}


include "../include/header.php";


if (getval("submit","")=="")
	{
	# ------------------- Show the size selection screen -----------------------
	?>
	<div class="BasicsBox"> 
	  <h1><?php echo htmlspecialchars($lang["buynow"])?></h1>
	  <p><?php echo htmlspecialchars($lang["buynowintro"])?></p>

	<form method="post" action="<?php echo $baseurl_short?>pages/purchase.php">
        <?php generateFormToken("buynow"); ?>
	<table class="InfoTable">
	<?php 
	$showbuy=false;
	$resources=do_search("!collection" . $usercollection);
	foreach ($resources as $resource)
		{
		?><tr><?php
		$sizes=get_image_sizes($resource["ref"]);
		$title=get_data_by_field($resource["ref"],$view_title_field);
        if(trim($title)=="")
            {
            $title = $lang["resourceid"] . "&nbsp;" . $resource["ref"];
            }
		?><td><?php echo $title?></td><td>
		<?php
		if (count($sizes)==0)
			{
			?>
			<?php echo htmlspecialchars($lang["nodownloadsavailable"]) ?>
			<?php
			}
		else
			{
			?><select class="stdwidth" name="select_<?php echo $resource["ref"] ?>"><?php
			# List all sizes with pricing options.
			foreach ($sizes as $size)
				{
				$name=$size["name"];
				$id=$size["id"];
				$showbuy=true;
				if ($id=="") {$id="hpr";}

				if (array_key_exists($id,$pricing))
					{
					$price=$pricing[$id];
					}
				else
					{
					$price=999; # Error.
					}

				# Pricing adjustment hook (for discounts or other price adjustments plugin).
				$priceadjust=hook("adjust_item_price","",array($price,$resource["ref"],$size["id"]));
				if ($priceadjust!==false)
					{
					$price=$priceadjust;
					}


				?>
				<option value="<?php echo $size["id"] ?>"  <?php if ($size["id"]==$resource["purchase_size"]) { ?>selected<?php } ?>><?php echo $name . " - " . $currency_symbol . " " . number_format($price,2)  ?></option>
				<?php
				}
			?></select><?php
			}
		?>
		</td>
		</tr><?php	
		}
	?>
	</table>
	<p>&nbsp;</p>
	<?php hook("purchase_extra_options"); 

	// If we are anonymous, give the user an option to add an emailk address so they can receive confirmation of order
	if((isset($anonymous_login) && ($username==$anonymous_login)) && isset($rs_session) && $anonymous_user_session_collection)
		{
		echo "<br />" . $lang["purchase_email_address"] . "<br />";
		echo "<br /><input type=\"text\" name=\"email_confirmation\" ></input><br /><br />";

		}
		?>

	<?php if ($showbuy) { ?>
		<p><input type="submit" name="submit" value="&nbsp;&nbsp;&nbsp;<?php echo escape($lang["buynow"])?>&nbsp;&nbsp;&nbsp;"></p>
	<?php } ?>
	</form>
	</div>
<?php
	}
else
    {
    # ----------------------------------- Show the PayPal integration instead ------------------------------------
    $pricing_discounted=$pricing; # Copy the pricing, which may be group specific
    # Reinclude the config so that $pricing is now the default, and we can work out group discounts
    $pricing = $GLOBALS['system_wide_config_options']["pricing"];

	$resources=do_search("!collection" . $usercollection);
	$n=1;
	$paypal="";
	$totalprice=0;
	$totalprice_ex_discount=0;
	foreach ($resources as $resource)
		{
		$sizes=get_image_sizes($resource["ref"]);
		$title=get_data_by_field($resource["ref"],$view_title_field);
		foreach ($sizes as $size)
			{
			if (getval("select_" . $resource["ref"],"")==$size["id"])
				{
				$name=$size["name"];
				$id=$size["id"];
				if ($id=="") {$id="hpr";}
				
				# Add to total price				
				if (array_key_exists($id,$pricing_discounted)) {$price=$pricing_discounted[$id];}	else {$price=999;}

				# Add to ex-discount price also
				if (array_key_exists($id,$pricing)) {$price_ex_discount=$pricing[$id];}	else {$price_ex_discount=999;}
				$totalprice_ex_discount+=$price_ex_discount;
								
				# Pricing adjustment hook (for discounts or other price adjustments plugin).
				$priceadjust=hook("adjust_item_price","",array($price,$resource["ref"],$size["id"]));
				if ($priceadjust!==false)
					{
					$price=$priceadjust;
					}
								
				$totalprice+=$price;
				# Build up the paypal string...
				$paypal.="<input type=\"hidden\" name=\"item_name_" . $n . "\" value=\"" . $title . " (" . $lang["id"] . ":" . $resource["ref"] . ", " . $size["name"] . ")\">\n";
				$paypal.="<input type=\"hidden\" name=\"amount_" . $n . "\" value=\"" . $price . "\">\n";
				$paypal.="<input type=\"hidden\" name=\"quantity_" . $n . "\" value=\"1\">\n";
				$n++;

				# Store the selected size for use by the download page later; also store the price so it can be logged in the resource log if/when the purchase is completed.
				purchase_set_size($usercollection,$resource["ref"],$size["id"],$price);
				}
			}
		}	
	
	
	
	?>
	<div class="BasicsBox"> 
	<h2>&nbsp;</h2>
	<h1><?php echo ($userrequestmode==2)?$lang["proceedtocheckout"]:$lang["accountholderpayment"] ?></h1>
	<?php hook ("price_display_extras"); ?>

	<table class="InfoTable">
	<tr><td><?php echo htmlspecialchars($lang["subtotal"]) ?></td><td align="right"><?php echo $currency_symbol . " " . number_format($totalprice_ex_discount,2) ?></td></tr>

	<?php if ($totalprice!=$totalprice_ex_discount || true) { 
		# Display discount (always for now)
		?>	
		<tr><td><?php echo htmlspecialchars($lang["discountsapplied"]) ?></td><td align="right"><?php echo $currency_symbol . " " . number_format($totalprice_ex_discount-$totalprice,2) ?></td></tr>
<?php
		}
	?>
			
	<tr><td><strong><?php echo htmlspecialchars($lang["totalprice"]) ?></strong></td><td align="right"><strong><?php echo $currency_symbol . " " . number_format($totalprice,2) ?></strong></td></tr>
	</table>
	<br />
	
	<?php if ($userrequestmode==2)
		{
		# Payment immediate - use PayPal.
		if (!hook("paymentgateway")) # Allow other payment gateways to be hooked in, instead of PayPal.
			{
			?>
			<form name="_xclick" class="form" action="<?php echo $paypal_url . "/cgi-bin/webscr" ?>" method="post">
			<input type="hidden" name="cmd" value="_cart">
			<input type="hidden" name="upload" value="1">
			<input type="hidden" name="business" value="<?php echo $payment_address ?>">
			<input type="hidden" name="currency_code" value="<?php echo $payment_currency ?>">
			<input type="hidden" name="cancel_return" value="<?php echo $baseurl?>">
			<input type="hidden" name="notify_url" value="<?php echo $baseurl?>/pages/purchase_callback.php">
			<input type="hidden" name="return" value="<?php echo $baseurl?>/pages/purchase_download.php?collection=<?php echo urlencode($usercollection) ?>&emailconfirmation=<?php echo urlencode(getval("email_confirmation","")); ?>">
			<input type="hidden" name="custom" value="<?php echo urlencode($userref." ".$usercollection); ?>">
			<input type="hidden" name="charset" value="utf-8">
			<?php echo $paypal ?>
			<p><input type="submit" name="submit" value="&nbsp;&nbsp;&nbsp;<?php echo escape($lang["proceedtocheckout"])?>&nbsp;&nbsp;&nbsp;"></p>
			</form>
			<?php
			}
		}
	?>
	
	<?php if ($userrequestmode==3)
		{
		# Invoice payment.
		?>
		<form method="post" action="<?php echo $baseurl_short?>pages/purchase.php" onsubmit="return confirm('<?php echo escape($lang["areyousurepayaccount"]) ?>');">
            <?php generateFormToken("purchaseonaccount_form"); ?>
		<p><input type="submit" name="purchaseonaccount"  value="&nbsp;&nbsp;&nbsp;<?php echo escape($lang["purchaseonaccount"])?>&nbsp;&nbsp;&nbsp;"></p>

		</form>
<?php
		}
	?>
	</div>
<?php
}

include "../include/footer.php";
?>
