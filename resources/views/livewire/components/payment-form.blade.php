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
        width: 90%;
        left: 20px;
        height: 170px;
        margin: 0 15px 30px;
        overflow: hidden;
        border-radius: 28px;
        box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px,
                rgba(0, 0, 0, 0.23) 0px 6px 6px;
        border: 5px solid #6c757d69 !important;
    }

    .ag-courses_item_small {
        width: 30%;
        left: 20px;
        height: 170px;
        margin: 0 15px 30px;
        overflow: hidden;
        border-radius: 28px;
        box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px,
                rgba(0, 0, 0, 0.23) 0px 6px 6px;
        border: 5px solid #6c757d69 !important;
    }

    .ag-courses-item_link {
        display: block;
        padding: 24px 20px;
        background-color: #ffffff;
        overflow: hidden;
        position: relative;
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
    padding: 24px 13px;
  }
  .ag-courses-item_date-box {
    font-size: 16px;
  }
}

.card-wrap{
  width: 100%;
  border-radius: 20px;
  border: 5px solid #fff;
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
  width: 80%;
  margin: 100px auto 100px;

}
.card-title{
  text-transform: uppercase;
  font-size: 18px;
  margin-top: -50px;
  margin-bottom: 20px;
  font-weight: 700;
  color: #ffffff !important;

}
.card-text{
  text-align: center;
  font-size: 12px;
  margin-bottom: 20px;
}

.card-header {
    border-bottom: 5px solid #fff !important;
}

:root {
  --color-text: #616161;
  --color-text-btn: #ffffff;
  --card1-gradient-color1: #42abe1;
  --card1-gradient-color2: #b8e0f4;
  --card2-gradient-color1: #459594;
  --card2-gradient-color2: #95cecd;
  --card3-gradient-color1: #ed8060;
  --card3-gradient-color2: #fbe3db;
  --card4-gradient-color1: #225294;
  --card4-gradient-color2: #6496db;

}

  .card-header.one {
    background: linear-gradient(
      to bottom left,
      var(--card1-gradient-color1),
      var(--card1-gradient-color2)
    );
  }
  .card-header.two {
    background: linear-gradient(
      to bottom left,
      var(--card2-gradient-color1),
      var(--card2-gradient-color2)
    );
  }
  .card-header.three {
    background: linear-gradient(
      to bottom left,
      var(--card3-gradient-color1),
      var(--card3-gradient-color2)
    );
  }
  .card-header.four {
    background: linear-gradient(
      to bottom left,
      var(--card4-gradient-color1),
      var(--card4-gradient-color2)
    );
  }


/* fin prueba card */

.symbol {
  font-size: 15px;
}

.cent {
    font-size: 17px;
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
