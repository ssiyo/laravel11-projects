<!-- Previously Messaged Users/Groups -->
<div class="flex-grow border-t border-gray-400 pt-4">
    <!-- User/Group items go here -->
    @if(Route::is('register'))
    <span class="flex py-1 pl-4 text-white bg-blue-800">
        register
    </span>
    @else
    <a href="{{ route('register') }}" class="flex py-1 pl-4 text-white hover:bg-gray-900">
        register
    </a>
    @endif

    @if(Route::is('login'))
    <span class="flex py-1 pl-4 text-white bg-blue-800">
        login
    </span>
    @else
    <a href="{{ route('login') }}" class="flex py-1 pl-4 text-white hover:bg-gray-900">
        login
    </a>
    @endif


</div>