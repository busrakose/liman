<div class="row">
    <div class="col-12">
        
        @include("modal-button", [
            "text" => "Search File",
            "class" => "btn-primary",
            "target_id" => "trailerModal"
        ])

        @component("modal-component", [
            "id" => "trailerModal",
            "footer" => [
                "class" => "btn-danger",
                "onclick" => "trailerEvent()",
                "text" => "Search"
            ]
        ])
            <input class="form-control mb-4" type="text" placeholder="File Name" name="filename" id="filename">

        @endcomponent

        <div id="fileTable">

        </div>
    </div>
</div>
@include("trailer.scripts")