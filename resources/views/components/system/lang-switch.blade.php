<div>
    <form id="langSwitcherForm" action="{{ route('system.lang.switch') }}" method="POST">
        @csrf

        <div class="col-span-6 sm:col-span-4">
            <select id="langSwitcher" name="lang" class="select-- mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" @change="changeCategory">
                @foreach(Config::get('languages') as $key => $language)
                <option
                    value="{{ $key }}"
                    @if(Session::get('applocale') == $key) selected='selected' @endif
                >{{ $language }}</option>
            @endforeach
            </select>
          </div>
    </form>

    <script type="text/javascript">
        var langForm = document.getElementById('langSwitcher');
        langForm.addEventListener('change', function(e) {
            document.getElementById('langSwitcherForm').submit();
        });
    </script>

</div>
