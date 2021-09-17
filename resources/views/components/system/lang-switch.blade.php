<div>
    <form id="langSwitcherForm" action="{{ route('system.lang.switch') }}" method="POST">
        @csrf

        <select id="langSwitcher" name="lang">
            @foreach(Config::get('languages') as $key => $language)
                <option
                    value="{{ $key }}"
                    @if(Session::get('applocale') == $key) selected='selected' @endif
                >{{ $language }}</option>
            @endforeach
        </select>
    </form>

    <script type="text/javascript">
        var langForm = document.getElementById('langSwitcher');
        langForm.addEventListener('change', function(e) {
            document.getElementById('langSwitcherForm').submit();
        });
    </script>

</div>
