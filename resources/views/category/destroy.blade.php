<div  class="modal fadeIn" id="destroy-category{{$category->id ?? 'Default'}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Esborrar l'àrea</h4>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>

            <div class="modal-body">
                <p>Segur que desitja esborrar aquesta àrea?</p>
                <div style="padding:5px;">
                    <h5>Nom: {{$category->category_name ?? 'Default'}}</h5>
                </div>
                <div style="padding:5px;">
                    <h5>descripció: {{$category->description ?? 'Default'}}</h5>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel·lar</button>
                <form action="{{Route('category.destroy', $category->id ?? 'Default')}}" method="POST">
                    @csrf
                    @method('delete')
                    <input type="submit" class="btn btn-danger" value="Sí, esborrar!">
                </form>
               </div>
        </div>
    </div>
</div>
