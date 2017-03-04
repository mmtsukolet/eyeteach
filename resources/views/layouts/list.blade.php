<?php $url = URL::to("admin/". strtolower($class) . "/create"); ?>
<div class="col-sm-12">
      <a href={{$url}} class="btn btn-success pull-right"><i class='icon-plus'></i> CREATE</a>
      <br><br>
</div>  
<div class="animated fadeIn">
  <div class="col-lg-12">
      <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> <b><?= ucwords($class) ?></b> List
            </div>
            <div class="card-block">
                <table id='tbl_{{ $class }}' class="table display table-sm table-condensed table-hover">
                    <thead>
                      <tr>
                        @foreach ($thead as $head)
                          <th>{{$head}}</th>    
                        @endforeach
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($tdata as $k => $data)
                        <tr>
                        @foreach ($data as $item)
                            <td>{{$item}}</td>
                        @endforeach
                          <td><a href='{{ URL::to("admin/". strtolower($class) . "/" . $tdata[$k]['id']) . "/edit" }}' class="btn btn-info"><i class='icon-note'></i>  Edit</a></td>
                          <td><button onclick="deleteHandler('<?= $tdata[$k]['id']; ?>', '<?= $class; ?>')" type='button' href='#' class="btn btn-danger"><i class='icon-trash'></i> Delete</button></td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
      </div>
  </div>
</div>