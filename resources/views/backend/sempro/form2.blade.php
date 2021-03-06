 <div class="form-group">
 <label for="nama">Nama Mahasiswa</label>
 {{ Form::text('nama',null, ['class' => 'form-control', 'id' => 'nama', 'placeholder' => 'Nama Mahasiswa','readonly' => 'readonly']) }}
 </div>

<div class="form-group">
    <label for="semhas_at">Tanggal Seminar Proposal</label>
    {{ Form::input('date', 'sempro_at', null, ['class' => 'form-control', 'id' => 'semhas_at', 'placeholder' => 'Tanggal Seminar Proposal']) }}
</div>

<div class="form-group">
    <label for="semhas_time">Waktu Seminar Proposal</label>
    {{ Form::input('time', 'sempro_time', null, ['class' => 'form-control', 'id' => 'semhas_time', 'placeholder' => 'Waktu Seminar Proposal']) }}
</div>  

<div class="form-group">
    <label for="proposal_status">Status Proposal</label>
    {{ Form::text('proposal_status', null, ['class' => 'form-control', 'id' => 'proposal_status', 'placeholder' => 'Status Proposal']) }}
</div>


<div class="form-group">
    <label for="file_proposal">File Proposal (PDF)</label>
    {{ Form::file('file_proposal', null,)}}
</div>

<div class="form-group">
    <label for="semhas_deadline_at">Semhas Deadline</label>
    {{ Form::input('date', 'semhas_deadline_at', null, ['class' => 'form-control', 'id' => 'semhas_deadline', 'placeholder' => 'Deadline Seminar Proposal']) }}
</div>