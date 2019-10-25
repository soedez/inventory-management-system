$(document).ready(function () {

    //for notification
    $(".notification").slideDown(300);

    $(".notification").delay(4000).fadeOut("slow");


    //logout click

    $("#log_out").click(function () {
        if (confirm("Do you want to logout?")) {
            $.ajax({
                url: '../Controller/LoginController.php',
                type: 'post',
                data: {logout: true},
                success: function () {
                    location.reload();
                    
                }
            })
        }
    });


    $("#category").change(function(){
        var id = $(this).val();
        //alert(id);
        $.ajax({
            url : '../Controller/PurchaseController.php',
            type : 'post',
            data : {cat_id: id},
            dataType: "json",
            success: function (data){
                $('#product').empty();

                if(data.length == 0 ){
                    $('#product').append("<option value='0'>No Product Found</option>");
                    $('#product').prop('disabled', 'disabled');
                }else{
                    $('#product').removeAttr("disabled");
                    $('#product').append("<option value='0' selected>Select Product</option>");
                    $.each(data,function(key, value) {
                        $('#product').append("<option value='"+ value.product_id +"'>"+ value.product_name +"</option>");
                    });
                }
            }
        })
    });


    $("#fcategory").change(function(){
        var id = $(this).val();
        //alert(id);
        $.ajax({
            url : '../Controller/PurchaseController.php',
            type : 'post',
            data : {cat_id: id},
            dataType: "json",
            success: function (data){
                $('#fproduct').empty();

                if(data.length == 0 ){
                    $('#fproduct').append("<option value='0'>No Product Found</option>");
                    $('#fproduct').prop('disabled', 'disabled');
                }else{
                    $('#fproduct').removeAttr("disabled");
                    $('#fproduct').append("<option value='0' selected>Select Product</option>");
                    $.each(data,function(key, value) {
                        $('#fproduct').append("<option value='"+ value.product_id +"'>"+ value.product_name +"</option>");
                    });
                }
            }
        })
    });


    $("#product_search").keyup(function(){
        var search = $(this).val();

        // alert(search);
        $.ajax({
            url : '../Controller/ProductController.php',
            type : 'post',
            data : {search_product: search},
            dataType : "json",
            success: function (data){
                $('#product_data').empty();

                if(data.length != 0 ){
                    $.each(data,function(key, value) {
                        $('#product_data').append("<tr><td>"+ (key+1) +"</td>"
                            + "<td><img src='../images/"+ value.image +"' style='height: 40px; width: 40px' class='rounded-circle'></td>"
                            + "<td>"+ value.product_name +"</td>"
                            + "<td>"+ value.minimum_qty +"</td>"
                            + "<td>"+ value.manufacturer +"</td>"
                            + "<td>"+ value.category +"</td>"
                            + "<td><a href='edit-product.php?edit_pro="+value.product_id+"' class='btn btn-info btn-sm'><i class='fas fa-pencil-alt'></i></a></td>"
                            + "<td><a href='../Controller/ProductController.php?delete_pro="+ value.product_id +"' class='btn btn-danger btn-sm'><i class='fas fa-trash-alt'></i></a></td></tr>"
                        );
                    });
                }else{
                    $('#product_data').append("<tr class='text-center text-danger'><td colspan='8'>No Product Yet</td></tr>");
                }
            }
        })
    });


    $("#stock_search").keyup(function(){
        var search = $(this).val();

        // alert(search);
        $.ajax({
            url : '../Controller/ProductController.php',
            type : 'post',
            data : {search_stock: search},
            dataType : "json",
            success: function (data){
                $('#stock_data').empty();

                if(data.length != 0 ){
                    $.each(data,function(key, value) {
                        $('#stock_data').append("<tr><td>"+ (key+1) +"</td>"
                            + "<td><img src='../images/"+ value.image +"' style='height: 40px; width: 40px' class='rounded-circle'></td>"
                            + "<td>"+ value.product_name +"</td>"
                            + "<td>"+ value.minimum_qty +"</td>"
                            + "<td>"+ value.manufacturer +"</td>"
                            + "<td>"+ value.category +"</td>"
                            + "<td>"+ value.total_sales +"</td>"
                            + "<td>"+ value.total_purchases +"</td>"
                            + "<td>"+ value.available_quantity +"</td></tr>"
                        );
                    });



                }else{
                    $('#stock_data').append("<tr class='text-center text-danger'><td colspan='9'>No Product Found</td></tr>");
                }
            }
        })
    });

});

