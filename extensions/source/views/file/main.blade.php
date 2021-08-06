<div class="row">
    <div class="col-12">
        
        @include("modal-button", [
            "text" => "Add File",
            "class" => "btn-primary",
            "target_id" => "fileModal"
        ])
        

        @component("modal-component", [
            "id" => "fileModal",
            "footer" => [
                "class" => "btn-danger",
                "onclick" => "fileEvent()",
                "text" => "Add"
            ]
        ])
            <input class="form-control mb-4" type="text" placeholder="File Name" name="fileName" id="fileName">
            
        @endcomponent

        <div id="filesTable">

        </div>
    </div>
</div>
@include("file.scripts")