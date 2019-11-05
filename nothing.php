<tr>
							<td colspan="3" align="right"> Delovery Location</td>
							<td align="right" colspan="2"> <b><select class="form-control" name="location" style="width:330px;" required>
                                            <option value="50">Nyeri CBD</option>
                                            <option value="100">King'ong'o</option>
											<option value="150">Kamakwa</option>
											<option value="100">Skuta</option>
											<option value="120">Ring Road</option>
											<option value="200">Dedan Kimathi University</option>
                                        </select> </b></td>

                        </tr>
                        <select class="form-control" name="bloodgroup" required>
                                            <option value="1" selected>Select your Blood Group</option>
                                            <?php $sql = "SELECT * from  tblbloodgroup ";
                                            $query = $dbh -> prepare($sql);
                                            $query->execute();
                                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt=1;
                                            if($query->rowCount() > 0)
                                            {
                                            foreach($results as $result)
                                            {               ?>  
                                            <option value="<?php echo htmlentities($result->BloodGroup);?>"><?php echo htmlentities($result->BloodGroup);?></option>
                                            <?php }} ?>
                                        </select>