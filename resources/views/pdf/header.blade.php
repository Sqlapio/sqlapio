<style>
    .header {
        text-align: center;
        margin-top: 30px;
        margin-left: auto;
        margin-right: auto;
        font-size: 20px;
    }
</style>

<div class="header">
    <div style="display: flex; flex-direction: column; align-items: center;">
        <span class="text-capitalize" style="font-size: 20px;">{{ $nombre }}</span></strong>
        <span class="text-capitalize" style="font-size: 15px;">C.I: {{ $ci }} / MPPS: {{ $mpps }}</span>
        <span class="text-capitalize" style="font-size: 15px;">Especialidad: {{ $especialidad }}</span>
    </div>
</div>