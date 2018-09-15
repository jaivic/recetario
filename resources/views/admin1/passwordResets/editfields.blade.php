<fieldset>
<section>
    {!! Form::label('email', 'email:',['class' => 'label']) !!}
    <label class="input">
         {!! Form::text('email', null, ['class' => 'input-xs']) !!}
    </label>
</section><section>
    {!! Form::label('token', 'token:',['class' => 'label']) !!}
    <label class="input">
         {!! Form::text('token', null, ['class' => 'input-xs']) !!}
    </label>
</section><section>
    {!! Form::label('created_at', 'created_at:',['class' => 'label']) !!}
    <label class="input">
         {!! Form::text('created_at', null, ['class' => 'input-xs']) !!}
    </label>
</section>
</fieldset>
<footer> 
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin1.passwordresets.index') !!}" class="btn btn-default">Cancel</a>
</footer>