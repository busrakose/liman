<script>
    function trailer(){
        //Swal.fire("User sekmesi açıldı.")
        getFile(); 
    }
    function trailerEvent(){
        showSwal("{{('Yükleniyor...')}}", 'info');
        let data = new FormData();
        data.append("filename",$("#trailerModal").find("#filename").val());

        request("{{API('set_file')}}", data, function(response){
           // getFile();
           $("#fileTable").html(response);
           $('#trailerModal').modal('hide');

            response = JSON.parse(response);
            Swal.close();
            Swal.fire(response.message);
            Swal.close();

            $("#fileTable").html(response);

        }, function(response){
            response = JSON.parse(response);
            showSwal(response.message, 'error');
        });

    }

    function getFile(){
        showSwal("{{('Yükleniyor...')}}", 'info');
        let data = new FormData();

        request("{{API('get_file')}}", data, function(response){

        Swal.close();
        $("#fileTable").html(response);
        },function(response){
            response = JSON.parse(response);
            showSwal(response.message, 'error');
        });


    }
    function Event(){
        showSwal("{{__('Yükleniyor...')}}", 'info');
        let data = new FormData();
        request("{{API('add_trailer')}}", data, function(response){
            response = JSON.parse(response);
            $('.hostname').text(response.message);
            Swal.close();
            $('#setHostnameModal').modal('hide');
        }, function(response){
            response = JSON.parse(response);
            showSwal(response.message, 'error');
        });

    }
</script>