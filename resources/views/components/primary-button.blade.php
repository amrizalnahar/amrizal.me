<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150']) }} style="background-color: #C3110C;" onmouseover="this.style.backgroundColor='#740A03'" onmouseout="this.style.backgroundColor='#C3110C'" onfocus="this.style.backgroundColor='#740A03'" onactive="this.style.backgroundColor='#740A03'">
    {{ $slot }}
</button>
