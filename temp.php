temp 
<form action="updateHistory.php" method="post">
        <div class="container">
            <p>Medical History</p>
            Smoker/Non Smoker:
            <input type="radio" name="smoker" value="Yes" <?php if ($row['smoker'] == "Yes") echo "checked"; ?> required>
            <label for="yes">Smoker</label>
            <input type="radio" name="smoker" value="No"<?php if ($row['smoker']== "No") echo "checked"; ?>>
            <label for="no">Non Smoker</label><br>
            Asthma:
            <input type="radio" name="asthma" value="Yes"<?php if ($row['asthma'] == "Yes") echo "checked"; ?> required>
            <label for="yes">Yes</label>
            <input type="radio" name="asthma" value="No"<?php if ($row['asthma'] == "No") echo "checked"; ?>>
            <label for="no">No</label>
            <input type="radio" name="asthma" value="Unknown"<?php if ($row['asthma']== "Unknown") echo "checked"; ?>>
            <label for="unknown">Unknown</label><br>
            Diabetes:
            <input type="radio" name="diabetes" value="Yes"<?php if ($row['diabetes'] == "Yes") echo "checked"; ?>required>
            <label for="yes">Yes</label>
            <input type="radio" name="diabetes" value="No"<?php if ($row['diabetes']== "No") echo "checked"; ?>>
            <label for="no">No</label>
            <input type="radio" name="diabetes" value="Unknown"<?php if ($row['diabetes'] == "Unknown") echo "checked"; ?>>
            <label for="unknown">Unknown</label><br>
            Heart Disease:
            <input type="radio" name="heart_disease" value="Yes"<?php if ($row['heart_disease'] == "Yes") echo "checked"; ?>required>
            <label for="yes">Yes</label>
            <input type="radio" name="heart_disease" value="No"<?php if ($row['heart_disease'] == "No") echo "checked"; ?>>
            <label for="no">No</label>
            <input type="radio" name="heart_disease" value="Unknown"<?php if ($row['heart_disease'] == "Unknown") echo "checked"; ?>>
            <label for="unknown">Unknown</label><br>
            Hypertension:
            <input type="radio" name="hypertension" value="Yes"<?php if ($row['hypertension'] == "Yes") echo "checked"; ?>required>
            <label for="yes">Yes</label>
            <input type="radio" name="hypertension" value="No"<?php if ($row['hypertension'] == "No") echo "checked"; ?>>
            <label for="no">No</label>
            <input type="radio" name="hypertension" value="Unknown"<?php if ($row['hypertension'] == "Unknown") echo "checked"; ?>>
            <label for="unknown">Unknown</label><br>
            Stroke:
            <input type="radio" name="stroke" value="Yes"<?php if ($row['stroke'] == "Yes") echo "checked"; ?>required>
            <label for="yes">Yes</label>
            <input type="radio" name="stroke" value="No"<?php if ($row['stroke'] == "No") echo "checked"; ?>>
            <label for="no">No</label>
            <input type="radio" name="stroke" value="Unknown"<?php if ($row['stroke']== "Unknown") echo "checked"; ?>>
            <label for="unknown">Unknown</label><br>
            Cancer:
            <input type="radio" name="cancer" value="Yes"<?php if ($row['cancer'] == "Yes") echo "checked"; ?>required>
            <label for="yes">Yes</label>
            <input type="radio" name="cancer" value="No"<?php if ($row['cancer'] == "No") echo "checked"; ?>>
            <label for="no">No</label>
            <input type="radio" name="cancer" value="Unknown"<?php if ($row['cancer'] == "Unknown") echo "checked"; ?>>
            <label for="unknown">Unknown</label><br>
            Tuberculosis:
            <input type="radio" name="tuberculosis" value="Yes"<?php if ($row['tuberculosis'] == "Yes") echo "checked"; ?>required>
            <label for="yes">Yes</label>
            <input type="radio" name="tuberculosis" value="No"<?php if ($row['tuberculosis']  == "No") echo "checked"; ?>>
            <label for="no">No</label>
            <input type="radio" name="tuberculosis" value="Unknown"<?php if ($row['tuberculosis']  == "Unknown") echo "checked"; ?>>
            <label for="unknown">Unknown</label><br>
            Skin Disesase:
            <input type="radio" name="skin_disease" value="Yes"<?php if ($row['skin_disease'] == "Yes") echo "checked"; ?>required>
            <label for="yes">Yes</label>
            <input type="radio" name="skin_disease" value="No"<?php if ($row['skin_disease'] == "No") echo "checked"; ?>>
            <label for="no">No</label>
            <input type="radio" name="skin_disease" value="Unknown"<?php if ($row['skin_disease'] == "Unknown") echo "checked"; ?>>
            <label for="unknown">Unknown</label><br>
            Kidney Problem:
            <input type="radio" name="kidney" value="Yes"<?php if ($row['kidney']  == "Yes") echo "checked"; ?>required>
            <label for="yes">Yes</label>
            <input type="radio" name="kidney" value="No"<?php if ($row['kidney'] == "No") echo "checked"; ?>>
            <label for="no">No</label>
            <input type="radio" name="kidney" value="Unknown"<?php if ($row['kidney'] == "Unknown") echo "checked"; ?>>
            <label for="unknown">Unknown</label><br>
            Fits/Psychiatric:
            <input type="radio" name="fits_psychiatric" value="Yes"<?php if ($row['fits_psychiatric'] == "Yes") echo "checked"; ?>required>
            <label for="yes">Yes</label>
            <input type="radio" name="fits_psychiatric" value="No"<?php if ($row['fits_psychiatric']== "No") echo "checked"; ?>>
            <label for="no">No</label>
            <input type="radio" name="fits_psychiatric" value="Unknown"<?php if ($row['fits_psychiatric'] == "Unknown") echo "checked"; ?>>
            <label for="unknown">Unknown</label><br>

            <p>Family History</p>
            <label for="father_history">Father: </label>
            <input type="text" name="father_history" maxlength="30"><br>
            <label for="mother_history">Mother: </label>
            <input type="text" name="mother_history" maxlength="30"><br>
            <label for="siblings_history">Siblings: </label>
            <input type="text" name="siblings_history" maxlength="30"><br>
            <label for="habits">Habits: </label>
            <input type="text" name="habits" maxlength="30"><br>
            <label for="allergy">Allergy: </label>
            <input type="text" name="allergy" maxlength="30"><br>
            <label for="others">Others: </label>
            <input type="text" name="others" maxlength="30"><br>
            <p>Medication: </p>
            <input type="text" name="medication" maxlength="50"><br><br>
            <input type="submit" value="Update Info">
            <input type="hidden" name="mrn" value="<?php echo $mrn; ?>">
            </div>
        </form>