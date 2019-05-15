<?php


?>


          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Siparişler </h1>
          <p class="mb-4">Şu an görülen Siparişler Mayıs ayına aittir.</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3 row">
              <span class="m-0 font-weight-bold text-primary col-8">Mayıs ayı siparişleri</span>

                    <span class="col-4">
                        <label class="m-0 font-weight-bold text-primary">Ay seçiniz</label>
                            <select id="inputState" class="form-control">
                            <option selected>Db den seç</option>
                            <option>2019-01</option>
                            <option>2019-02</option>
                            <option>2019-03</option>
                        </select>
                    </span>

            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Sipariş Numarası</th>
                      <th>Ad Soyad</th>
                      <th>Tutar</th>
                      <th>Not </th>
                      <th>Tarih</th>
                      <th>Sipariş</th>
                      <th>Durum</th>
                    </tr>
                  </thead>
                  <tfoot>
                      <th>Sipariş Numarası</th>
                      <th>Ad Soyad</th>
                      <th>Tutar</th>
                      <th>Not </th>
                      <th>Tarih</th>
                      <th>Sipariş</th>
                      <th>Durum</th>
                  </tfoot>
                  <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
