<fieldset>
<section>
    {!! Form::label('permission_id', 'permission_id:',['class' => 'label']) !!}
    <label class="input">
         {!! Form::text('permission_id', null, ['class' => 'input-xs']) !!}
    </label>
</section><section>
    {!! Form::label('role_id', 'role_id:',['class' => 'label']) !!}
    <label class="input">
         {!! Form::text('role_id', null, ['class' => 'input-xs']) !!}
    </label>
</section>
</fieldset>
<footer> 
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin1.permissionrole.index') !!}" class="btn btn-default">Cancel</a>
</footer>