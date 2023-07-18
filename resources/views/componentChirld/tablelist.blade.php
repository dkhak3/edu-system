

@foreach ($courses as $e)
<tr>
    <td> <input type="checkbox"  data-item="{{$e->id}}" class="checklist" name="checkall"></td>
    <td>{{$e->name}}</td>
    <td  class="mbl-none">{{$e->description}}</td>
    <td class="mbl-none">{{$e->startdate}}</td>
    <td class="mbl-none">{{$e->enddate}}</td>
    <td style="white-space: nowrap"><button type="button"  class="btn btnEdit btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap" data-id="{{$e->id}}"><i class="fa-solid fa-pen"></i></button> | <button data-item="{{$e->id}}" class="btn btn-danger btnDelete"><i class="fa-solid fa-trash"></i></button></td>
  </tr>
@endforeach

@if (count($courses) ==0)
    <tr><td class="text-center" colspan="6">Không Có Dữ Liệu</td></tr>
@endif
