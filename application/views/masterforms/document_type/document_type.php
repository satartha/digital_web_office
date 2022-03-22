<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container-fluid page-body-wrapper">
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                    <div class="card">
                        <div class="card-header" style="background-color:#ff4f00">
                            <h3 class="card-title text-white" > Document Type Form</h3>
                        </div>
                        <div class="card-body">
                        
                            <form id="frmDp">
                            <input type="hidden" id="txtid" name="txtid" value="0">
                                
                                <div class="form-group">
                                    <label for="pn" class="control-label mb-1">Document Type Name</label>
                                    <input type="text" class="form-control" name="txtDpname" id="pcnm" onclick="charachters_validate('pcnm')" placeholder="Enter Department Name" minlength="1" maxlength="30" required>
                                </div><br>
                               
                               
                                <div class="text-right">
                                    <button type="reset" class="btn btn-danger btn-sm">Reset</button>
                                    <button type="submit" class="btn btn-primary btn-sm" id="btnSubmit">Create</button>
                                </div>
                            </form>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
                    <div class="card card-secondary">
                        <div class="card-header" style="background-color:#ff4f00">
                            <h3 class="card-title text-white">Report</h3>
                        </div>
                        <div class="card-body">
                            <table id="pcReport" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th class="text-center">Sl#</th>
                                   
                                    <th class="text-center">Document Type Name</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody id="pcrpt" class="text-center">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


