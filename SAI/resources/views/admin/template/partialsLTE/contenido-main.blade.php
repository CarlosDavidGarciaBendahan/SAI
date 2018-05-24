<!-- Main content -->
              <section class="content">
                <div class="row">
                  <!-- <div class="col-sm-8 offset-2"> -->
                    @include('flash::message')
                  <!-- </div> -->
                </div>
                
                <div class="row">
                  @yield('body')
                </div>

              </section>
              <!-- /.content -->