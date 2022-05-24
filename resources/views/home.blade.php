 @extends('layouts.app')

@section('content')

{{-- @if(Auth::check() && (Auth::user()->role == 'normal')) --}}

<style>
    .my_element {padding: 10px; margin: 0 0 20px 0;}

    @keyframes show-animate {
        from { transform: scale(0); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }

    @keyframes hide-animate {
        from { transform: scale(1); opacity: 1; }
        to { transform: scale(0); opacity: 0; }
    }


    /* animate new box */
    .show-element { animation: show-animate .3s linear; }
    .hide-element { animation: hide-animate .3s linear; }

    .card_background{
        background: linear-gradient(0deg, rgba(140,143,130,0) 0%, rgba(217,217,217,1) 0%, rgba(180,195,218,0) 100%, rgba(246,246,246,1) 100%);
    }

    .my_background_body{
        margin-top: -20px;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle, rgba(150,205,228,1) 10%, rgba(53,141,201,1) 81%, rgba(61,87,156,0.6629026610644257) 100%);
    }

</style>

<div class="my_background_body">

<div class="container ">

{{-- <div style="background-image: url({{asset('img/background.jpg')}});"> --}}
    <div class="row justify-content-center">


        <div class="col-md-8">
                <div class="container mt-5">


                        <div class="row d-flex justify-content-center">
                            <div class="col-md-10">

                                @if (session('message'))
                                    <div class="alert alert-success" style="margin-top: -60px;">
                                        <h4>{{ session('message') }}</h4>
                                    </div>
                                @endif

                                <div class="card p-3  py-4 card_background">

                                    <div style="width:100%; text-align:center">
                                        <h3 >Búsqueda de videos</h3>
                                        <img class="card-img-top" src="{{asset('img/videoteca.png')}}" alt="Card image cap" style="width:35%; height: 35%;" >
                                    </div>

                                    <form action="{{route('videos.search')}}" method="POST" id="formSearch" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row g-3 mt-2" >
                                            <div class="col-md-3" >
                                                <select class="form-select btn btn-secondary dropdown-toggle" type="button"  id="fieldSelected" name="fieldSelected">
                                                    @if(Auth::check() && Auth::user()->role == 'normal')
                                                        <option selected value="id">ID</option>
                                                    @endif

                                                    <option value="Titulo_Original">Titulo original</option>
                                                    <option value="Titulo_en_Mexico">Titulo en México</option>
                                                    <option value="Actor_Principal">Actor principal</option>
                                                    <option value="Actriz_Principal">Actriz principal</option>
                                                    <option value="Nombre_del_Director">Director</option>
                                                    <option value="genero">Género</option>
                                                </select>
                                            </div>

                                            <div class="col-md-6">
                                                <input type="text" class="form-control" placeholder="Ingrese un campo" name="search" id="search" required>
                                            </div>

                                            <div class="col-md-3">
                                                <button class="btn btn-secondary btn-block" type="submit">Buscar</button>
                                            </div>
                                        </div>

                                        <div class="row g-3 mt-2" >
                                            <div class="col-md-center" id="fieldsContainer">
                                                <select style="display: none;" name="Genero" class="form-select btn btn-secondary dropdown-toggle" id="genderSelect">

                                                    <option id="genderEmptyOption" selected value="-"> Seleccione Género </option>
                                                    <option value="Accion"> Accion </option>
                                                    <option value="Animacion"> Animacion </option>
                                                    <option value="Aventura"> Aventura </option>
                                                    <option value="Belico"> Belico </option>
                                                    <option value="Biblico"> Biblico </option>
                                                    <option value="Categra"> Categra C.S </option>
                                                    <option value="Categra"> Categra Cortazar </option>
                                                    <option value="Categra"> Categra en video </option>
                                                    <option value="Ciencia"> Ciencia Ficcion </option>
                                                    <option value="Cine"> Cine Negro </option>
                                                    <option value="Cine"> Cine Negro Ganster </option>
                                                    <option value="Cine"> Cine Negro Policiano </option>
                                                    <option value="Comedia"> Comedia </option>
                                                    <option value="Comedia"> Comedia Ranchera </option>
                                                    <option value="Comedia"> Comedia Romantica </option>
                                                    <option value="Conferencia"> Conferencia Congreso </option>
                                                    <option value="Cortometraje"> Cortometraje </option>
                                                    <option value="Curso"> Curso </option>
                                                    <option value="Diplomado"> Diplomado </option>
                                                    <option value="Documental"> Documental </option>
                                                    <option value="Documental"> Documental historico </option>
                                                    <option value="Drama"> Drama </option>
                                                    <option value="Drama"> Drama belico </option>
                                                    <option value="Drama"> Drama biografico </option>
                                                    <option value="Drama"> Drama familiar </option>
                                                    <option value="Drama"> Drama indigenista </option>
                                                    <option value="Drama"> Drama politico </option>
                                                    <option value="Drama"> Drama psicologico </option>
                                                    <option value="Erotico"> Erotico </option>
                                                    <option value="Experimental"> Experimental </option>
                                                    <option value="Fantasia"> Fantasia </option>
                                                    <option value="Guerra"> Guerra </option>
                                                    <option value="Historico"> Historico de epocas </option>
                                                    <option value="Homenajes"> Homenajes </option>
                                                    <option value="informes"> informes </option>
                                                    <option value="Melodrama"> Melodrama </option>
                                                    <option value="Musical"> Musical </option>
                                                    <option value="Nota"> Nota periodica </option>
                                                    <option value="Novela"> Novela historica </option>
                                                    <option value="Opera"> Opera </option>
                                                    <option value="Policiano"> Policiano  </option>
                                                    <option value="Road"> Road movie  </option>
                                                    <option value="Romance"> Romance  </option>
                                                    <option value="Seminario"> Seminario  </option>
                                                    <option value="Suspenso"> Suspenso  </option>
                                                    <option value="terror"> terror  </option>
                                                    <option value="triller"> triller  </option>
                                                    <option value="TV"> TV-Program opinion  </option>
                                                    <option value="Western"> Western </option>

                                                </select>
                                            </div>
                                        </div>

                                        </div>
                                <div style="margin-top: 10em;"></div>

                                    </form>
                    </div>
                            </div>
                        </div>
                    </div>
        {{-- </div> --}}
    </div>
    </div>



</div>

<footer class="text-center text-lg-start text-white my_footer" style="background-color: #45526e">
    <!-- Grid container -->
    <div class="container p-4 pb-0">
      <!-- Section: Links -->
      <section class="">
        <!--Grid row-->
        <div class="row">
          <!-- Grid column -->
          <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
            <img src="img/cta_logo.jpg" alt="cta_logo" style="width: 160%; height: 100%; margin-left: -9em; ">
          </div>

          <hr class="w-100 clearfix d-md-none" />

          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3" >
          <br>
            <h6 class="text-uppercase mb-4 font-weight-bold">Contacto</h6>
            {{-- <p><i class="fas fa-home mr-3"></i> Cucsh Belenes</p> --}}
            <p><i class="fas fa-envelope mr-3"></i> cta.cucsh@administrativos.udg.mx</p>
            <p><i class="fas fa-phone mr-3"></i> +52 33 3819 3300 ext: 23609</p>
            {{-- <p><i class="fas fa-print mr-3"></i> + 01 234 567 89</p> --}}
          </div>
          <!-- Grid column -->
        </div>
        <!--Grid row-->
      </section>
      <!-- Section: Links -->

      <hr class="my-3">

      <!-- Section: Copyright -->
      <section class="p-3 pt-0">
        <div class="row d-flex align-items-center">
          <!-- Grid column -->
          <div class="col-md-7 col-lg-8 text-center text-md-start">
            <!-- Copyright -->
            <div class="p-3">
              Coordinación de Tecnologias para el Aprendizaje - Universidad de Guadalajara

            </div>
            <!-- Copyright -->
          </div>
          <!-- Grid column -->

          <!-- Grid column -->

          <!-- Grid column -->
        </div>
      </section>
      <!-- Section: Copyright -->
    </div>
    <!-- Grid container -->
  </footer>


<!-- Remove the container if you want to extend the Footer to full width. -->
{{-- <div class="container my-5"> --}}

  <!-- Footer -->
{{-- </div> --}}
<!-- End of .container -->

{{-- Search styles --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script type="text/javascript">

const selectedValue = document.getElementById('fieldSelected');
const searchField = document.getElementById('search');
let genderSelect = document.getElementById('genderSelect');
const genderEmptyOption = document.getElementById('genderEmptyOption');
let showAnimation = false;


selectedValue.addEventListener('change', (event) => {
    genderSelect = document.getElementById('genderSelect');
    if(selectedValue.value == 'genero'){
        searchField.placeholder = 'Seleccione un Género';
        searchField.disabled = true;

        genderSelect.classList.remove('my_element', 'hide-element');
        genderSelect.classList.add('my_element', 'show-element');
        genderSelect.style.display = 'block';
        showAnimation = true;


    }else{
        searchField.disabled = false;
        searchField.placeholder = 'Ingrese un campo';

        if(showAnimation){
            genderSelect.classList.remove('my_element', 'show-element');
            genderSelect.classList.add('my_element', 'hide-element');
            showAnimation = false;
        }
    }
});

genderSelect.addEventListener('animationend', (event) => {
    if(selectedValue.value == 'genero'){
        genderSelect.style.display = 'block';
        genderEmptyOption.selected = true;
    }else{
        genderSelect.style.display = 'none';
        genderEmptyOption.selected = true;
    }
});

genderSelect.addEventListener('change', (event) => {
    document.getElementById('formSearch').submit();
});

</script>



@endsection
