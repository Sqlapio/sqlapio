@extends('layouts.app-auth')
@section('title', 'Pago del plan')
<style>
    .logo-bank {
        width: 40%;
        height: auto;
    }

    .ico-check {
        background: #C3D8ED;
        border-radius: 20px;
    }

    .logoSq {
        width: 30% !important;
        height: auto;
    }

    .img-icon-select-rol {
        width: 100%;
        height: auto;
    }

    @media only screen and (max-width: 576px) {

        .form-sq-mv {
            align-content: flex-start !important;
        }

        .mt-m3 {
            margin-top: 20px
        }

        .logoSq {
            width: 30%;
            height: auto;
        }

        .logo-bank {
            width: 20px;
            margin-left: 20px;
        }

    }



/* card */

    .ag-courses_item {
        /* -ms-flex-preferred-size: calc(33.33333% - 30px);
        flex-basis: calc(33.33333% - 30px); */
        width: 200px;
        left: 20px;
        height: 150px;
        margin: 0 15px 30px;
        overflow: hidden;
        border-radius: 28px;
        /* position: absolute; */
        z-index: 3;
        box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px,
                rgba(0, 0, 0, 0.23) 0px 6px 6px;

    }
    .ag-courses-item_link {
        display: block;
        padding: 30px 20px;
        background-color: #ffffff;

        overflow: hidden;

        position: relative;
    }
    .ag-courses-item_link:hover,
    .ag-courses-item_link:hover .ag-courses-item_date {
    text-decoration: none;
    color: #002f41;
    }
    .ag-courses-item_link:hover .ag-courses-item_bg {
    -webkit-transform: scale(10);
    -ms-transform: scale(10);
    transform: scale(10);
    }



    .ag-courses-item_title {
        min-height: 87px;
        margin: 0 0 25px;
        overflow: hidden;
        font-weight: bold;
        font-size: 25px;
        color: #050303;
        z-index: 2;
        position: relative;
    }

    a {
        text-decoration: none !important;
    }
    /* .ag-courses-item_date-box {
    font-size: 18px;
    color: #FFF;

    z-index: 2;
    position: relative;
    } */
    /* .ag-courses-item_date {
    font-weight: bold;
    color: #f9b234;

    -webkit-transition: color .5s ease;
    -o-transition: color .5s ease;
    transition: color .5s ease
    } */
    .ag-courses-item_bg {
    height: 128px;
    width: 128px;
    background-color: #4cb0e3;

    z-index: 1;
    position: absolute;
    top: -75px;
    right: -75px;

    border-radius: 50%;

    -webkit-transition: all .5s ease;
    -o-transition: all .5s ease;
    transition: all .5s ease;
    }
    .ag-courses_item:nth-child(2n) .ag-courses-item_bg {
    background-color: #8fc9c8;
    }
    .ag-courses_item:nth-child(3n) .ag-courses-item_bg {
    background-color: #8bc6c5;
    }
    .ag-courses_item:nth-child(4n) .ag-courses-item_bg {
    background-color: #952aff;
    }
    .ag-courses_item:nth-child(5n) .ag-courses-item_bg {
    background-color: #cd3e94;
    }
    .ag-courses_item:nth-child(6n) .ag-courses-item_bg {
    background-color: #4c49ea;
    }



@media only screen and (max-width: 979px) {
  .ag-courses_item {
    -ms-flex-preferred-size: calc(50% - 30px);
    flex-basis: calc(50% - 30px);
  }
  .ag-courses-item_title {
    font-size: 20px;
  }
}

@media only screen and (max-width: 767px) {
  .ag-format-container {
    width: 96%;
  }

}
@media only screen and (max-width: 639px) {
  .ag-courses_item {
    -ms-flex-preferred-size: 100%;
    flex-basis: 100%;
  }
  .ag-courses-item_title {
    min-height: 72px;
    line-height: 1;

    font-size: 24px;
  }
  .ag-courses-item_link {
    padding: 22px 40px;
  }
  .ag-courses-item_date-box {
    font-size: 16px;
  }
}

.card-wrap{
  width: 100%;
  background: #fff;
  border-radius: 20px;
  border: 1px solid #fff;
  overflow: hidden;
  color: var(--color-text);
  box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px,
              rgba(0, 0, 0, 0.23) 0px 6px 6px;
  cursor: pointer;
  transition: all .2s ease-in-out;
  margin-top: -100px
}

.card-content{
  display: flex;
  flex-direction: column;
  /* align-items: center; */
  width: 80%;
  margin: 100 auto 0;

}
.card-title{
  text-align: center;
  text-transform: uppercase;
  font-size: 16px;
  margin-top: 10px;
  margin-bottom: 20px;

}
.card-text{
  text-align: center;
  font-size: 12px;
  margin-bottom: 20px;
}

/* fin prueba card */

.cent {
    font-size: 25px;
    vertical-align: text-top;
}

.time {
    font-size: 13px;
}

</style>
@push('scripts')

@endpush
@section('content')
    <div>
        @livewire('components.stripe.payment-method')
    </div>
@endsection
