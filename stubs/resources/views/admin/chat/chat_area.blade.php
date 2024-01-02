<div class="overflow-auto chat-box">
    @if($chatUsers->count() > 0 || $chatStudents->count() > 0)
        @if($chatUsers->count() > 0)
            <h4 class="mb-1 fs-6 text-dark fw-bold">
                Users
            </h4>
            @foreach ($chatUsers as $user)
                @php 
                $seenStatus = null;
                $userData = App\User::where('id', $user->user_id)->first();
                if(!$userData){
                    $userData = App\Models\Student::where('id', $user->user_id)->first();
                }
                $conversation = App\Models\Conversation::where('chat_room_id', $user->chat_room_id)->latest()->first();
                $seenStatus = App\Models\Conversation::where('chat_room_id', $user->chat_room_id)->first();
                @endphp
                <input type="hidden" value="{{$user->user_id}}" name="user_id{{$user->user_id}}" id="user_id{{$user->user_id}}">
                <input type="hidden" value="last seen {{$userData ? $userData->updated_at->diffForHumans(): ''}}" name="updated_at{{$user->user_id}}" id="updated_at{{$user->user_id}}">
                <input type="hidden" value="{{$user->chat_room_id}}" name="chat_room_id{{$user->user_id}}" id="chat_room_id{{$user->user_id}}">
                <div class="d-flex py-2 chat-list" onclick="userChatArea('{{$user->user_id}}','{{$userData ? $userData->first_name : ''}}')">
                    <div class="mr-1">
                        <img src="{{ asset('uploads/user/'.$user->photo) }}" alt="" class="profile-img" srcset="" onerror="this.src='{{ asset('dashboard/images/user/avatar-1.jpg') }}';">
                    </div>
                    <div class="w-100 ms-2">
                        <a href="#!" id="user_name{{$user->user_id}}"  data-id="2" data-name="{{$userData ? $userData->first_name : ''}}" class="chat-user text-white">
                            <div class="d-flex justify-content-between">
                                <h4 class="mb-1 fs-6 text-dark fw-bold">{{ $userData ? $userData->first_name : ''}} ({{ $userData ? @$userData->roles[0]->name : ''}})</h4>
                                {{-- <span class="me-3">4 hours ago</span> --}}
                            </div>
                        </a>
                        <div>
                            @if(isset($conversation->sender_id))
                                @if($conversation->sender_id == auth()->id())
                                <i class="ik ik-corner-up-right"></i>
                                @else
                                <i class="ik ik-corner-up-left"></i>
                                @endif
                                <p>{{ \Str::limit($conversation ? $conversation->message : '',35,'...')  }} </p>
                            @else
                                <i class="ik ik-corner-up-left"></i>  No Conversation Stated Yet!
                            @endif
                            {{-- <p>laoreet dolore magna.....</p> --}}
                        </div>
                    </div>
                </div>
            @endforeach
        
        @endif
        @if($chatStudents->count() > 0)
            <h4 class="mb-1 fs-6 text-dark fw-bold">
                Students
            </h4>
            @foreach ($chatStudents as $user)
                @php 
                $seenStatus = null;
                $userData = App\Models\Student::where('id', $user->user_id)->first();
                if(!$userData){
                    $userData = App\Models\Student::where('id', $user->user_id)->first();
                }
                $conversation = App\Models\Conversation::where('chat_room_id', $user->chat_room_id)->latest()->first();
                $seenStatus = App\Models\Conversation::where('chat_room_id', $user->chat_room_id)->first();
                @endphp
                <input type="hidden" value="{{$user->user_id}}" name="user_id{{$user->user_id}}" id="user_id{{$user->user_id}}">
                <input type="hidden" value="last seen {{$userData ? $userData->updated_at->diffForHumans(): ''}}" name="updated_at{{$user->user_id}}" id="updated_at{{$user->user_id}}">
                <input type="hidden" value="{{$user->chat_room_id}}" name="chat_room_id{{$user->user_id}}" id="chat_room_id{{$user->user_id}}">
                <div class="d-flex py-2 chat-list" onclick="userChatArea('{{$user->user_id}}','{{$userData ? $userData->first_name : ''}}')">
                    <div class="mr-1">
                        <img src="{{ asset('uploads/user/'.$user->photo) }}" alt="" class="profile-img" srcset="" onerror="this.src='{{ asset('dashboard/images/user/avatar-1.jpg') }}';">
                    </div>
                    <div class="w-100 ms-2">
                        <a href="#!" id="user_name{{$user->user_id}}"  data-id="2" data-name="{{$userData ? $userData->first_name : ''}}" class="chat-user text-white">
                            <div class="d-flex justify-content-between">
                                <h4 class="mb-1 fs-6 text-dark fw-bold">{{ $userData ? $userData->first_name : ''}}</h4>
                                {{-- <span class="me-3">4 hours ago</span> --}}
                            </div>
                        </a>
                        <div>
                            @if(isset($conversation->sender_id))
                                @if($conversation->sender_id == auth()->id())
                                <i class="ik ik-corner-up-right"></i>
                                @else
                                <i class="ik ik-corner-up-left"></i>
                                @endif
                                <p>{{ \Str::limit($conversation ? $conversation->message : '',35,'...')  }} </p>
                            @else
                                <i class="ik ik-corner-up-left"></i>  No Conversation Stated Yet!
                            @endif
                            {{-- <p>laoreet dolore magna.....</p> --}}
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    @else
        <div class="text-center py-2 chat-list">
            No Participants Yet!
        </div>
    @endif
</div>