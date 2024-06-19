@extends('welcome')

@section('content')

<table style="color:black;" class="w-100">
    <tr style="border-bottom: 1px solid black;">
        <td>ID</td>
        <td>-</td>
        <td>{{$conference[0]->id}}</td>
    </tr>

    <tr style="border-bottom: 1px solid black;">
        <td>Status</td>
        <td>-</td>
        <td>{{$conference[0]->status}}</td>
    </tr>

    <tr style="border-bottom: 1px solid black;">
        <td>Accept Notification</td>
        <td>-</td>
        <td>{{$conference[0]->accept_noti}}</td>
    </tr>
    <tr style="border-bottom: 1px solid black;">
        <td>Email</td>
        <td>-</td>
        <td>{{$conference[0]->email}}</td>
    </tr>
    <tr style="border-bottom: 1px solid black;">
        <td>Local Fee</td>
        <td>-</td>
        <td>{{$conference[0]->local_fee}} MMKS</td>
    </tr>
    <tr style="border-bottom: 1px solid black;">
        <td>Foreign Fee</td>
        <td>-</td>
        <td>{{$conference[0]->foreign_fee}} MMKS</td>
    </tr>
    <tr style="border-bottom: 1px solid black;">
        <td>Conference Date</td>
        <td>-</td>
        <td>{{$conference[0]->conference_date}}</td>
    </tr>
    <tr style="border-bottom: 1px solid black;">
        <td>Topics</td>
        <td>-</td>
        <td>AI / Data mining</td>
    </tr>

</table>
<h2 class="text-dark mt-5">Committee Members</h2>
<table  class="w-100">
    <tr style="background-color: #3798A6;">
    <td style="border: 1px solid white;padding:2px;">#</td>
        <td style="border: 1px solid white;padding:2px;">Name</td>
        <td style="border: 1px solid white;padding:2px;">Nation</td>
        <td style="border: 1px solid white;padding:2px;">University</td>
        <td style="border: 1px solid white;padding:2px;">Rank</td>
        <td style="border: 1px solid white;padding:2px;">Position</td>
        <td style="border: 1px solid white;padding:2px;">Speaker Type</td>
        <td style="border: 1px solid white;padding:2px;">Member Type</td>
        <td style="border: 1px solid white;padding:2px;">Chair Type</td>
    </tr>

    @foreach($members as $member)
    <tr style="background-color: #3798A6;">
        <td style="border: 1px solid white;padding:2px;">{{$member->id}}</td>
        <td style="border: 1px solid white;padding:2px;">{{$member->name}}</td>
        <td style="border: 1px solid white;padding:2px;">{{$member->nation}}</td>
        <td style="border: 1px solid white;padding:2px;">{{$member->university}}</td>
        <td style="border: 1px solid white;padding:2px;">{{$member->rank}}</td>
        <td style="border: 1px solid white;padding:2px;">{{$member->position}}</td>
        <td style="border: 1px solid white;padding:2px;">{{$member->speaker_type}}</td>
        <td style="border: 1px solid white;padding:2px;">{{$member->member_type}}</td>
        <td style="border: 1px solid white;padding:2px;">{{$member->chair_type}}</td>
    </tr>
    @endforeach
</table>

<h2 class="text-dark mt-5">Images Used</h2>
@foreach($images as $i)
    <div class="text-dark">{{$i->name}}</div>
    <!-- <img src="{{$i->name}}" style="width: 300px;height:300px;"/> -->
    <img src="https://www.uit.edu.mm/wp-content/uploads/2020/04/Blooddonar13-600x400.jpg" style="width: 300px;height:300px;"/>
@endforeach
@endsection