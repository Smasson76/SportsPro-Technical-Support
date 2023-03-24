<?php include '../view/header.php'; ?>
<main>
    <h1>View/Update Customer</h1>
    <form action="index.php" method="post" id="view_customer_form">
        <input type="hidden" name="action" value="update_customer">

        <label></label>
        <input type="hidden" name="customerID" value="<?php echo $customer_id;?>"/>
        <br>

        <label>First Name:</label>
        <input type="text" name="firstName" value="<?php echo $first_name;?>"/>
        <?php echo $fields->getField('fnameVal')->getHTML(); ?>
        <br>

        <label>Last Name:</label>
        <input type="text" name="lastName" value="<?php echo $last_name;?>"/>
        <?php echo $fields->getField('lnameVal')->getHTML(); ?>
        <br>

        <label>Address:</label>
        <input type="text" name="address" value="<?php echo $address;?>"/>
        <?php echo $fields->getField('addressVal')->getHTML(); ?>
        <br>

        <label>City:</label>
        <input type="text" name="city" value="<?php echo $city;?>"/>
        <?php echo $fields->getField('cityVal')->getHTML(); ?>
        <br>

        <label>State:</label>
        <input type="text" name="state" value="<?php echo $state;?>"/>
        <br>

	  <label>Country:</label>
	  <select id="Country" name="Country">
		<option value="United States">United States</option>
		<option value="Canada">Canada</option>
		<option value="China">China</option>
		<option value="India">India</option>
		<option value="Brazil">Brazil</option>
		<option value="Russia">Russia</option>
		<option value="Mexico">Mexico</option>
		<option value="Japan">Japan</option>
		<option value="Egypt">Egypt</option>
		<option value="Vietnam">Vietnam</option>
		<option value="Turkey">Turkey</option>
		<option value="Iran">Iran</option>
		<option value="Germany">Germany</option>
		<option value="Thailand">Thailand</option>
		<option value="United Kingdom">United Kingdom</option>
		<option value="France">France</option>
		<option value="Italy">Italy</option>
		<option value="South Africa">South Africa</option>
		<option value="Australia">Australia</option>
		<option value="South Korea">South Korea</option>
		<option value="North Korea">North Korea</option>
		<option value="Spain">Spain</option>
		<option value="Saudi Arabia">Saudi Arabia</option>
		<option value="Argentina">Argentina</option>
		<option value="Algeria">Algeria</option>
		<option value="Ukraine">Ukraine</option>
		<option value="Iraq">Iraq</option>
		<option value="Afghanistan">Afghanistan</option>
	  </select>
	  <br>

        <label>Postal Code:</label>
        <input type="text" name="postalCode" value="<?php echo $postal_code;?>"/>
        <?php echo $fields->getField('postalVal')->getHTML(); ?>
        <br>

        <label>Country Code:</label>
        <input type="text" name="countryCode" value="<?php echo $country_code;?>"/>
        <br>

        <label>Phone:</label>
        <input type="text" name="phone" value="<?php echo $phone;?>"/>
        <?php echo $fields->getField('phoneVal')->getHTML(); ?>
        <br>

        <label>Email:</label>
        <input type="text" name="email" value="<?php echo $email;?>"/>
        <?php echo $fields->getField('emailVal')->getHTML(); ?>
        <br>

        <label>Password:</label>
        <input type="text" name="password" value="<?php echo $password;?>"/>
        <?php echo $fields->getField('passwordVal')->getHTML(); ?>
        <br>

        <label>&nbsp;</label>
        <input type="submit" value="Update Customer" />
        <br>
    </form>
    <p class="last_paragraph">
        <a href="?action=manage_customers">Search Customers</a>
    </p>
</main>
<?php include '../view/footer.php'; ?>