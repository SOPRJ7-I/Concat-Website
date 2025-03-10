<x-Layout>
  <h1><p>All communitynights</p></h1>
</x-Layout>

@foreach($communityNights as $community)

    <p> {{$community->title}}</p>
    
@endforeach