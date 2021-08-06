<script>
    function file(){
        //Swal.fire("User sekmesi açıldı.")
        getFiles(); 
    }
    function fileEvent(){
        showSwal("{{('Yükleniyor...')}}", 'info');
        let data = new FormData();
        data.append("fileName" , $("#fileModal").find("#fileName").val());

        request("{{API('add_file')}}", data, function(response){
            response = JSON.parse(response);
            Swal.close();
            Swal.fire(response.message);

            $('#fileModal').modal('hide');

        }, function(response){
            response = JSON.parse(response);
            showSwal(response.message, 'error');
        });

    }

    function getFiles(){
        showSwal("{{('Yükleniyor...')}}", 'info');
        let data = new FormData();

        request("{{API('get_files')}}", data, function(response){
         $("#filesTable").html(response).find("table").dataTable(dataTablePresets("normal"));

           //$("#filesTable").html(response);
            Swal.close();

        },function(response){
            response = JSON.parse(response);
            showSwal(response.message, 'error');
        });

    }
</script>