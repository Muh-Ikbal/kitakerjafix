   @props(['services'])
   <div class="cards_layanan w-full rounded-lg">
       <div class="card relative h-[500px] w-full bg-white">
           <div class="min-h-[200px] max-h-[200px]"
               style="background-image: url('{{ asset('storage/' . $services->image) }}'); background-size: cover; background-position: center;">
           </div>
           <div class="card_content">
               <h2 class="card_title font-bold text-xl md:text-2xl text-black">{{ $services->name }}</h2>
               <p class="card_text text-black min-h-[110px] max-h-[110px] overflow-hidden">{{ $services->description }}</p>
               <span class="block text-slate-600  font-medium">Mulai dari</span>
               <p class="card_price font-semibold text-xl md:text-2xl text-black">Rp.
                   {{ number_format($services->price, 0, ',', '.') }}</p>
               <form action="/order/by-name/{{ Str::slug($services->name) }}" method="POST">
                   @csrf
                   <input type="hidden" name="id" value="{{ $services->id }}">
                   <button type="submit" class="btn mt-3 bg-[#1E56A0]">Pilih Jasa</button>
               </form>
           </div>
       </div>
   </div>
