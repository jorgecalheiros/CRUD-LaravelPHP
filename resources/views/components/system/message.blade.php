<div>
    @if ($errors->has("modal-*"))
        <div>
            <ul>
                @foreach ($errors->get("modal-*") as $modalMessage)
                 @foreach ($modalMessage as $message)
                    <div class="error-message">
                        <i class="fas fa-times space"></i>
                        <p class="space">{{ $message }}</p>
                    </div>
                 @endforeach
                @endforeach
            </ul>
        </div>
    @endif

    @if (Session::has("success-message"))
    <div class="error-message sucess-message">
        <i class="fas fa-times space"></i>
        <p class="space">{{ Session::get("success-message") }}</p>
    </div>
    @endif

</div>
