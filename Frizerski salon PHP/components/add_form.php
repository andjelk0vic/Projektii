<label for="salonname">Salon name:</label>
    <input type="text" name="salonname" value="<?php echo htmlspecialchars($salonname) ?>">
    <div class="red-text"><?php echo $errors['salonname']; ?></div>       

    <label for="author">Address:</label>
    <input type="text" name="address" value="<?php echo htmlspecialchars($address) ?>">
    <div class="red-text"><?php echo $errors['address']; ?></div> 

    <label for="category">Category:</label>
    <input type="text" name="category" value="<?php echo htmlspecialchars($category) ?>"
            onkeyup="showSuggestion(this.value)">
    <div class="red-text"><?php echo $errors['category']; ?></div>
    <p><span id="suggestion"></span></p>
