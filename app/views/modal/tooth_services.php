<?php
$config = new Config();
$path = $config->base_url('tooth/')
?>
<style>

</style>
<div class="modal fade" role="dialog" id="firstLeft">
    <div class="modal-dialog modal-sm" role="document">
        <form method="POST" action="<?php echo $config->base_url('services/oral_exam/services')?>">
            <input type="hidden" name="date" class="modal_date" value="0000-00-00" />
            <input type="hidden" name="profile_id" class="modal_profile_id" value="0" />
            <input type="hidden" name="bracket_id" class="modal_bracket_id" value="0" />
            <input type="hidden" name="barangay_id" class="modal_barangay_id" value="0" />
            <input type="hidden" name="tooth_no" class="modal_tooth_no" value="0" />
            <input type="hidden" name="female_status" class="modal_female_status" value="0" />
            <input type="hidden" name="code" class="modal_code" value="00000" />

            <input type="hidden" class="modal_b1" value="0">
            <input type="hidden" class="modal_b2" value="0">
            <input type="hidden" class="modal_b3" value="0">
            <input type="hidden" class="modal_b4" value="0">
            <input type="hidden" class="modal_b5" value="0">
            <div class="modal-content">
                <div class="modal-header">
                    <h4><i class="fa fa-stethoscope"></i> Services Rendered</h4>
                </div>
                <div class="modal-body">
                    <label>
                        Tooth # : <font class="text-bold text-primary tooth_name">0</font>
                    </label>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <label>
                                <input type="radio" onclick="showChart1($(this))" name="status" value="code_PFCo" required />
                                Permanent Filling (Composite)
                            </label>
                        </li>
                        <li class="list-group-item">
                            <label>
                                <input type="radio" onclick="showChart1($(this))" name="status" value="code_PFAm" required />
                                Permanent Filling (Amalgam)
                            </label>
                        </li>
                        <li class="list-group-item">
                            <label>
                                <input type="radio" onclick="showChart1($(this))" name="status" value="code_TF" required />
                                Temporary Filling
                            </label>
                        </li>
                        <li class="list-group-item">
                            <label>
                                <input type="radio" onclick="showChart1($(this))" name="status" value="code_M" required />
                                Tooth Extraction
                            </label>
                        </li>

                    </ul>
                    <div class="chart1 hide">
                        <table class="table table-bordered">
                            <tr>
                                <td></td>
                                <td><button type="button" onclick="showCode($(this))" value="2" class="btn col-sm-12 btn-default">Lingual</button></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><button type="button" onclick="showCode($(this))" value="1" class="btn col-sm-12 btn-default">Distal</button></td>
                                <td><button type="button" onclick="showCode($(this))" value="5" class="btn col-sm-12 btn-default">Incisal</button></td>
                                <td><button type="button" onclick="showCode($(this))" value="3" class="btn col-sm-12 btn-default"> Mesial </button></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><button type="button" onclick="showCode($(this))" value="4" class="btn col-sm-12 btn-default">Labial</button></td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-success btn-sm btn-submit" ><i class="fa fa-plus"></i> Add Status</button>
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" role="dialog" id="secondLeft">
    <div class="modal-dialog modal-sm" role="document">
        <form method="POST" action="<?php echo $config->base_url('services/oral_exam/services')?>">
            <input type="hidden" name="date" class="modal_date" value="0000-00-00" />
            <input type="hidden" name="profile_id" class="modal_profile_id" value="0" />
            <input type="hidden" name="bracket_id" class="modal_bracket_id" value="0" />
            <input type="hidden" name="barangay_id" class="modal_barangay_id" value="0" />
            <input type="hidden" name="tooth_no" class="modal_tooth_no" value="0" />
            <input type="hidden" name="female_status" class="modal_female_status" value="0" />
            <input type="hidden" name="code" class="modal_code" value="00000" />

            <input type="hidden" class="modal_b1" value="0">
            <input type="hidden" class="modal_b2" value="0">
            <input type="hidden" class="modal_b3" value="0">
            <input type="hidden" class="modal_b4" value="0">
            <input type="hidden" class="modal_b5" value="0">
            <div class="modal-content">
                <div class="modal-header">
                    <h4><i class="fa fa-stethoscope"></i> Services Rendered</h4>
                </div>
                <div class="modal-body">
                    <label>
                        Tooth # : <font class="text-bold text-primary tooth_name">0</font>
                    </label>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <label>
                                <input type="radio" onclick="showChart1($(this))" name="status" value="code_PFCo" required />
                                Permanent Filling (Composite)
                            </label>
                        </li>
                        <li class="list-group-item">
                            <label>
                                <input type="radio" onclick="showChart1($(this))" name="status" value="code_PFAm" required />
                                Permanent Filling (Amalgam)
                            </label>
                        </li>
                        <li class="list-group-item">
                            <label>
                                <input type="radio" onclick="showChart1($(this))" name="status" value="code_TF" required />
                                Temporary Filling
                            </label>
                        </li>
                        <li class="list-group-item">
                            <label>
                                <input type="radio" onclick="showChart1($(this))" name="status" value="code_M" required />
                                Tooth Extraction
                            </label>
                        </li>

                    </ul>
                    <div class="chart1 hide">
                        <table class="table table-bordered">
                            <tr>
                                <td></td>
                                <td><button type="button" onclick="showCode($(this))" value="2" class="btn col-sm-12 btn-default">Lingual</button></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><button type="button" onclick="showCode($(this))" value="1" class="btn col-sm-12 btn-default">Distal</button></td>
                                <td><button type="button" onclick="showCode($(this))" value="5" class="btn col-sm-12 btn-default">Occlusal</button></td>
                                <td><button type="button" onclick="showCode($(this))" value="3" class="btn col-sm-12 btn-default"> Mesial </button></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><button type="button" onclick="showCode($(this))" value="4" class="btn col-sm-12 btn-default">Labial</button></td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-success btn-sm btn-submit" ><i class="fa fa-plus"></i> Add Status</button>
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" role="dialog" id="firstRight">
    <div class="modal-dialog modal-sm" role="document">
        <form method="POST" action="<?php echo $config->base_url('services/oral_exam/services')?>">
            <input type="hidden" name="date" class="modal_date" value="0000-00-00" />
            <input type="hidden" name="profile_id" class="modal_profile_id" value="0" />
            <input type="hidden" name="bracket_id" class="modal_bracket_id" value="0" />
            <input type="hidden" name="barangay_id" class="modal_barangay_id" value="0" />
            <input type="hidden" name="tooth_no" class="modal_tooth_no" value="0" />
            <input type="hidden" name="female_status" class="modal_female_status" value="0" />
            <input type="hidden" name="code" class="modal_code" value="00000" />

            <input type="hidden" class="modal_b1" value="0">
            <input type="hidden" class="modal_b2" value="0">
            <input type="hidden" class="modal_b3" value="0">
            <input type="hidden" class="modal_b4" value="0">
            <input type="hidden" class="modal_b5" value="0">
            <div class="modal-content">
                <div class="modal-header">
                    <h4><i class="fa fa-stethoscope"></i> Services Rendered</h4>
                </div>
                <div class="modal-body">
                    <label>
                        Tooth # : <font class="text-bold text-primary tooth_name">0</font>
                    </label>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <label>
                                <input type="radio" onclick="showChart1($(this))" name="status" value="code_PFCo" required />
                                Permanent Filling (Composite)
                            </label>
                        </li>
                        <li class="list-group-item">
                            <label>
                                <input type="radio" onclick="showChart1($(this))" name="status" value="code_PFAm" required />
                                Permanent Filling (Amalgam)
                            </label>
                        </li>
                        <li class="list-group-item">
                            <label>
                                <input type="radio" onclick="showChart1($(this))" name="status" value="code_TF" required />
                                Temporary Filling
                            </label>
                        </li>
                        <li class="list-group-item">
                            <label>
                                <input type="radio" onclick="showChart1($(this))" name="status" value="code_M" required />
                                Tooth Extraction
                            </label>
                        </li>

                    </ul>
                    <div class="chart1 hide">
                        <table class="table table-bordered">
                            <tr>
                                <td></td>
                                <td><button type="button" onclick="showCode($(this))" value="2" class="btn col-sm-12 btn-default">Lingual</button></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><button type="button" onclick="showCode($(this))" value="1" class="btn col-sm-12 btn-default">Mesial</button></td>
                                <td><button type="button" onclick="showCode($(this))" value="5" class="btn col-sm-12 btn-default">Incisal</button></td>
                                <td><button type="button" onclick="showCode($(this))" value="3" class="btn col-sm-12 btn-default">Distal</button></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><button type="button" onclick="showCode($(this))" value="4" class="btn col-sm-12 btn-default">Labial</button></td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-success btn-sm btn-submit" ><i class="fa fa-plus"></i> Add Status</button>
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" role="dialog" id="secondRight">
    <div class="modal-dialog modal-sm" role="document">
        <form method="POST" action="<?php echo $config->base_url('services/oral_exam/services')?>">
            <input type="hidden" name="date" class="modal_date" value="0000-00-00" />
            <input type="hidden" name="profile_id" class="modal_profile_id" value="0" />
            <input type="hidden" name="bracket_id" class="modal_bracket_id" value="0" />
            <input type="hidden" name="barangay_id" class="modal_barangay_id" value="0" />
            <input type="hidden" name="tooth_no" class="modal_tooth_no" value="0" />
            <input type="hidden" name="female_status" class="modal_female_status" value="0" />
            <input type="hidden" name="code" class="modal_code" value="00000" />

            <input type="hidden" class="modal_b1" value="0">
            <input type="hidden" class="modal_b2" value="0">
            <input type="hidden" class="modal_b3" value="0">
            <input type="hidden" class="modal_b4" value="0">
            <input type="hidden" class="modal_b5" value="0">
            <div class="modal-content">
                <div class="modal-header">
                    <h4><i class="fa fa-stethoscope"></i> Services Rendered</h4>
                </div>
                <div class="modal-body">
                    <label>
                        Tooth # : <font class="text-bold text-primary tooth_name">0</font>
                    </label>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <label>
                                <input type="radio" onclick="showChart1($(this))" name="status" value="code_PFCo" required />
                                Permanent Filling (Composite)
                            </label>
                        </li>
                        <li class="list-group-item">
                            <label>
                                <input type="radio" onclick="showChart1($(this))" name="status" value="code_PFAm" required />
                                Permanent Filling (Amalgam)
                            </label>
                        </li>
                        <li class="list-group-item">
                            <label>
                                <input type="radio" onclick="showChart1($(this))" name="status" value="code_TF" required />
                                Temporary Filling
                            </label>
                        </li>
                        <li class="list-group-item">
                            <label>
                                <input type="radio" onclick="showChart1($(this))" name="status" value="code_M" required />
                                Tooth Extraction
                            </label>
                        </li>

                    </ul>
                    <div class="chart1 hide">
                        <table class="table table-bordered">
                            <tr>
                                <td></td>
                                <td><button type="button" onclick="showCode($(this))" value="2" class="btn col-sm-12 btn-default">Lingual</button></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><button type="button" onclick="showCode($(this))" value="1" class="btn col-sm-12 btn-default">Mesial</button></td>
                                <td><button type="button" onclick="showCode($(this))" value="5" class="btn col-sm-12 btn-default">Occlusal</button></td>
                                <td><button type="button" onclick="showCode($(this))" value="3" class="btn col-sm-12 btn-default">Distal</button></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><button type="button" onclick="showCode($(this))" value="4" class="btn col-sm-12 btn-default">Labial</button></td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-success btn-sm btn-submit" ><i class="fa fa-plus"></i> Add Status</button>
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" role="dialog" id="healthStatus">
    <div class="modal-dialog modal-sm" role="document">
        <form method="POST" action="<?php echo $config->base_url('services/oral_services')?>">
            <input type="hidden" name="date" class="modal_date" value="0000-00-00" />
            <input type="hidden" name="profile_id" class="modal_profile_id" value="0" />
            <input type="hidden" name="bracket_id" class="modal_bracket_id" value="0" />
            <input type="hidden" name="barangay_id" class="modal_barangay_id" value="0" />
            <input type="hidden" name="female_status" class="modal_female_status" value="0" />

            <div class="modal-content">
                <div class="modal-header">
                    <h4><i class="fa fa-stethoscope"></i> Services Rendered</h4>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <label>
                                <input type="checkbox" name="status[]" value="scaling" />
                                OP / Scaling
                            </label>
                        </li>
                        <li class="list-group-item">
                            <label>
                                <input type="checkbox" name="status[]" value="gum" />
                                Gum Treatment
                            </label>
                        </li>
                        <li class="list-group-item">
                            <label>
                                <input type="checkbox" name="status[]" value="sealant" />
                                Sealant
                            </label>
                        </li>
                        <li class="list-group-item">
                            <label>
                                <input type="checkbox" name="status[]" value="fluoride" />
                                Fluoride Therapy
                            </label>
                        </li>
                        <li class="list-group-item">
                            <label>
                                <input type="checkbox" name="status[]" value="operative" />
                                Post Operative Treatment
                            </label>
                        </li>
                        <li class="list-group-item">
                            <label>
                                <input type="checkbox" name="status[]" value="abscess" />
                                Oral Abscess Drained
                            </label>
                        </li>
                        <li class="list-group-item">
                            <label>Other Services</label>
                            <textarea class="form-control" rows="5" style="resize: vertical" name="others"></textarea>
                        </li>
                        <li class="list-group-item">
                            <label>Reffered</label>
                            <br />
                            <label>
                                <input type="radio" name="reffered" value="hospital" />
                                Hospital
                            </label>
                            <br />
                            <label>
                                <input type="radio" name="reffered" value="public_clinic" />
                                Other Public Dental Clinic
                            </label>
                            <br />
                            <label>
                                <input type="radio" name="reffered" value="private_clinic" />
                                Private Clinic
                            </label>
                        </li>
                        <li class="list-group-item">
                            <label>
                                <input type="checkbox" name="status[]" value="counselling" />
                                Given Cunselling / Education
                            </label>
                        </li>
                        <li class="list-group-item">
                            <label>
                                <input type="checkbox" name="status[]" value="drill" />
                                Toothbrushing Drill
                            </label>
                        </li>
                        <li class="list-group-item">
                            <label>Orally Fit Children (OFC)</label>
                            <br />
                            <label>
                                <input type="radio" name="ofc" value="upon_oral_exam" />
                                Upon Oral Examination
                            </label>
                            <br />
                            <label>
                                <input type="radio" name="ofc" value="upon_complete_rehab" />
                                Upon Complete Oral Rehab
                            </label>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-success btn-sm btn-submit" ><i class="fa fa-plus"></i> Add Status</button>
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
