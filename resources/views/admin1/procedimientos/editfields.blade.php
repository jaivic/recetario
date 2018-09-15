<fieldset>
<section>
    {!! Form::label('id', 'id:',['class' => 'label']) !!}
    <label class="input">
         {!! Form::text('id', null, ['class' => 'input-xs']) !!}
    </label>
</section><section>
    {!! Form::label('created_at', 'created_at:',['class' => 'label']) !!}
    <label class="input">
         {!! Form::text('created_at', null, ['class' => 'input-xs']) !!}
    </label>
</section><section>
    {!! Form::label('updated_at', 'updated_at:',['class' => 'label']) !!}
    <label class="input">
         {!! Form::text('updated_at', null, ['class' => 'input-xs']) !!}
    </label>
</section><section>
    {!! Form::label('procedimiento', 'procedimiento:',['class' => 'label']) !!}
    <label class="input">
         {!! Form::text('procedimiento', null, ['class' => 'input-xs']) !!}
    </label>
</section><section>
    {!! Form::label('img', 'img:',['class' => 'label']) !!}
    <label class="input">
         {!! Form::text('img', null, ['class' => 'input-xs']) !!}
    </label>
</section>
</fieldset>
<footer> 
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin1.procedimientos.index') !!}" class="btn btn-default">Cancel</a>
</footer>