$( document ).ready(function() {

    var currentPage = 1;
    var sort = 'employees-emp_no';
    var dir = 'asc';
    var searchKey = '';
    var searchValue = '';

    $('th.sortable').first().addClass('asc');

    loadTable(currentPage, sort, dir, searchKey, searchValue);

    $('.next').on('click', function() {
        currentPage = currentPage + 1;
        loadTable(currentPage, sort, dir, searchKey, searchValue);
    });

    $('.prev').on('click', function() {        
        if(currentPage > 1) {
            currentPage = currentPage - 1;
            loadTable(currentPage, sort, dir, searchKey, searchValue);
        }
    });

    $('th.sortable').on('click', function() {    

        sort = $(this).data('sort');

        if($(this).hasClass('asc')) {
            $(this).removeClass('asc').addClass('desc');
            dir = 'desc';
        } else if($(this).hasClass('desc')) {
            $(this).removeClass('desc').addClass('asc');
            dir = 'asc';
        } else {
            $('.asc').removeClass('asc');
            $('.desc').removeClass('desc');
            $(this).addClass('asc');
            dir = 'asc';
        }

        loadTable(currentPage, sort, dir, searchKey, searchValue);
    });

    $('input.searchable').on('change', function() {
        var val = $(this).val();
        $('input.searchable').val('');
        $(this).val(val);     
        searchKey = $(this).attr('id');
        searchValue = val;
        loadTable(currentPage, sort, dir, searchKey, searchValue);
    });

});

function loadTable(page, sort, dir, searchKey, searchValue) {

    $('table').addClass('loading');
    
    $.ajax({
        url: "/api/employees/" + page + '/' + sort + '/' + dir,
        type: "GET",     
        dataType : "json",
        data: {
            searchKey, 
            searchValue
        }
    })
    .done(function( data ) {
        var res='';

        if(data.employees.length == 0) {
            $('tbody').html('<tr><td colspan="9">No data</td></tr>');
        }

        $.each (data.employees, function (key, value) {
            var salary = 0;
            var department = '';
            if(typeof(value.salaries[0]) !== 'undefined') {
                salary = value.salaries[0].salary;
            }
            if(typeof(value.departments[0]) !== 'undefined') {
                department = value.departments[0].dept_name;
            }
            res +=
            '<tr>'+
                '<td>' + value.emp_no + '</td>' +
                '<td>' + value.first_name + '</td>' +
                '<td>' + value.last_name + '</td>' +
                '<td>' + value.gender + '</td>' +
                '<td>' + value.birth_date + '</td>' +
                '<td>' + value.hire_date + '</td>' +
                '<td>' + value.title.title + '</td>' +
                '<td>' + salary +'</td>' +
                '<td>' + department + '</td>' +
                '<td><a href="/employee/' + value.emp_no + '/edit" class="btn btn-warning">Edit</a></td>' +
            '</tr>';

            $('tbody').html(res);
            
      });

      $('table').removeClass('loading');
    });
}