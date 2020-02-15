@extends('layouts.sbk')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-outline-info">
                <div class="card-header">
                    <h4 class="mb-0 text-white">Micro Insurance Product</h4>
                </div>
                <div class="card-body">
                    <h6 class="card-subtitle">Define the product to be sold to consumers</h6>
                    <form class="form-material mt-4">
                        <div class="form-group">
                            <label>Product Title</label>
                            <input type="text" class="form-control form-control-line"> </div>
                        <div class="form-group">
                            <label>Course Description</label>
                            <textarea class="form-control" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Select the Insurance Provider to Underwrite this product</label>
                            <select class="form-control">
                                <option>Fortune Insurance Group</option>
                                <option>Generali Insurance</option>
                                <option>MVIT Insurance Corp</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>File upload</label>
                            <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                <div class="form-control" data-trigger="fileinput"> <i
                                        class="glyphicon glyphicon-file fileinput-exists"></i> <span
                                        class="fileinput-filename"></span></div> <span
                                    class="input-group-addon btn btn-default btn-file"> <span
                                        class="fileinput-new">Select file</span> <span
                                        class="fileinput-exists">Change</span>
                                    <input type="hidden">
                                    <input type="file" name="fileAttachmetn"> </span> <a href="#"
                                    class="input-group-addon btn btn-default fileinput-exists"
                                    data-dismiss="fileinput">Remove</a>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>
                                Save</button>
                            <button type="button" class="btn btn-inverse">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="/assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="/js/custom.min.js"></script>
    <!-- Magnific popup JavaScript -->
    <script src="/assets/plugins/Magnific-Popup-master/dist/jquery.magnific-popup.min.js"></script>
    <script src="/assets/plugins/Magnific-Popup-master/dist/jquery.magnific-popup-init.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="/assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
@endsection