<main>
<div class="container my-5">
       <div class="card-body text-center">

    <h4 class="card-title">Kullanıcılar Yetkilendirme</h4>
    
    <button id="add__new__list" type="button" class="btn btn-success " data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fas fa-plus"></i> Add a new List</button>

  </div>
    <div class="card ">
       
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Ad Soyad</th>
                <th scope="col">E-mail</th>
                <th scope="col">Düzenle </th>
                <th scope="col">Okuma</th>
                <th scope="col">Ekleme</th>
                <th scope="col">Düzenleme</th>
                <th scope="col">Silme</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>
                    <a class="btn btn-sm btn-primary" href="#"><i class="far fa-edit"></i> edit</a>
                    <a class="btn btn-sm btn-danger" href="#"><i class="fas fa-trash-alt"></i> delete</a>    
                </td>
               
                <td>
                    <label class="custom-control availability-checkbox checkbox-day">
                        <input type="checkbox" class="custom-control-input">
                        <span class="custom-control-indicator"></span>
                    </label>
                </td>
                <td>
                    <label class="custom-control availability-checkbox checkbox-evening">
                        <input type="checkbox" class="custom-control-input">
                        <span class="custom-control-indicator"></span>
                    </label>
                </td>
                <td>
                    <label class="custom-control availability-checkbox checkbox-night">
                        <input type="checkbox" class="custom-control-input">
                        <span class="custom-control-indicator"></span>
                    </label>
                </td>
                <td>
                    <label class="custom-control availability-checkbox checkbox-night">
                        <input type="checkbox" class="custom-control-input">
                        <span class="custom-control-indicator"></span>
                    </label>
                </td>
               
              </tr>
             
            </tbody>
          </table>
    </div>
    <!-- Large modal -->




<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
          <div class="card-body text-center">
            <h4 class="card-title">Yeni Kullanıcı Ekleme</h4>
            <p class="card-text">Bu kısımda eklenen kullanıcılar yetki verildiği taktirde sistemde değişiklik yapabilir. Kullanıcı varsayılan olarak hiçbir hakka sahip olmayacaktır. 
                Hakları kullanıcıyı kayıt ettikten sonra ayarlanması gerekmetedir .
            </p>
          </div>
            <div class=" card col-8 offset-2 my-2 p-3">
          <form>
            <div class="form-group">
              <label for="listname">Ad Soyad</label>
              <input type="text" class="form-control" name="listname" id="listname" placeholder="Ad Soyad">
            </div>
            <div class="form-group">
              <label for="datepicker">E-mail</label>
              <input  type="text" class="form-control" name="datepicker" id="datepicker" placeholder="E-mail">
            </div>
            <div class="form-group">
                                    <label for="datepicker">Parola</label>
                <div class="input-group">

                  <input type="text" class="form-control" placeholder="Parola" aria-label="Parola">
                
                </div>
              </div>
           <div class="form-group text-center">
             <button type="submit" class="btn btn-block btn-primary">Kullanıcyı Ekle</button>
          </div>
        </form>
    </div>
    </div>
  </div>
</div>
</div>
</main>



