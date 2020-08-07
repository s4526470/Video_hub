<?php
    echo !empty($statusMsg)?'<p class="status-msg">'.$statusMsg.'</p>':'';
    $length = 9;
?>
<div class="panel panel-default">
    <div class="panel-heading">Video Upload</div>
    <div class="panel-body">
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label>Choose Files</label>
                <input type="file" class="form-control" name="files[]" multiple/>
            </div>
            <div class="form-group">
                <input class="btn btn-info" type="submit" name="fileSubmit" value="UPLOAD" />
            </div>
        </form>
    </div>
</div>
<!-- Display uploaded videos -->
<div id="wrap" style="width:1200px; margin: 0px auto;" >
    <h3>Uploaded Videos<span id="text" style="display: none;"></span></h3>
    <div id="load_data"></div>
    <div id="load_data_message"></div>

</div>

<script>
    $(document).ready(function(){
        var limit = 6;
        var start = 0;
        var action = 'inactive';

        function lazzy_loader(limit)
        {
            var output = '';
            for(var count=0; count<limit; count++)
            {
                output += '<div class="post_data">';
                output += '</div>';
            }
            $('#load_data_message').html(output);
        }

        lazzy_loader(limit);

        function load_data(limit, start)
        {
            $.ajax({
                url:"<?php echo base_url(); ?>upload/fetch",
                method:"POST",
                data:{limit:limit, start:start},
                cache: false,
                success:function(data)
                {
                    if(data == '')
                    {
                        $('#load_data_message').html('<h3>No More Videos</h3>');
                        action = 'active';
                    }
                    else
                    {
                        $('#load_data').append(data);
                        $('#load_data_message').html("");
                        action = 'inactive';
                    }
                }
            })
        }

        if(action == 'inactive')
        {
            action = 'active';
            load_data(limit, start);
        }

        $(window).scroll(function(){
            if($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive')
            {
                lazzy_loader(limit);
                action = 'active';
                start = start + limit;
                setTimeout(function(){
                    load_data(limit, start);
                }, 2000);
            }
        });
    });
</script>


