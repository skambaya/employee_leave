<!-- Modal -->
            <div id="myModal<?php echo $row['leave_ID']?>" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Leave Take Action</h4>
                    </div>
                    <form action="controller/update_leave_details.php" method="post">
                    <div class="modal-body">
                    <input type="hidden" name="leave_ID" value="<?php echo $row['leave_ID']?>"/>
                    
                        <select name="leave_status" class="form-control" required>
                            <option value="<?php echo $row['leave_status']?>">Choose Action</option>
                            <option value="Approved">Approved</option>
                            <option value="Not Approved">Not Approved</option>
                        </select>
                        <br>

                        <textarea name="remark" class="form-control" placeholder="Supervisor Remark"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="update" class="btn btn-primary btn-sm">Submit</button>
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                    </div>
                    </form>
                    </div>
                </div>
                </div>