<h1>{{ __('Merhaba Dünya!') }}</h1>
{{ __('Hostname') }}: <span id="hostname"></span><br/>

@include('modal-button',[
    "class"     => "btn btn-primary mb-2",
    "target_id" => "setHostnameModal",
    "text"      => "Hostname Değiştir",
    "icon"      => "fas fa-plus"
])

@include('modal',[
    "id" => "setHostnameModal",
    "title" => "Hostname Değiştir",
    "url" => API('setHostname'),
    "next" => "getHostname",
    "inputs" => [
        "Hostname" => "hostname:text"
    ],
    "submit_text" => "Hostname Değiştir"
])

<script>
    getHostname();
    function getHostname(){
        showSwal('{{__("Yükleniyor...")}}', 'info');
        let data = new FormData();
        request("{{API("fetchHostname")}}", data, function(response){
            response = JSON.parse(response);
            $('#hostname').text(response.message);
            Swal.close();
            $('#setHostnameModal').modal('hide')
        }, function(response){
            response = JSON.parse(response);
            showSwal(response.message, 'error');
        });
    }
</script>