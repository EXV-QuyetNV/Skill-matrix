@extends('layouts.index')
@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <div style="margin-left: 40%">
            <h2>Skill Matrix</h2>
            <div class="d-flex" style="gap: 20px">
                <p style="padding: 10px 15px; background-color: #808080">-1</p>
                <span>Chưa biết, không có nhu cầu học</span>
            </div>
            <div class="d-flex" style="gap: 20px">
                <p style="padding: 10px 15px; background-color: #EE82EE">0</p>
                <span>Chưa biết, có thời gian sẽ học</span>
            </div>
            <div class="d-flex" style="gap: 20px">
                <p style="padding: 10px 15px; background-color: #FFB6C1">1</p>
                <span>cần đào tạo thêm mới làm được</span>
            </div>
            <div class="d-flex" style="gap: 20px">
                <p style="padding: 10px 15px; background-color: #FF1493">2</p>
                <span>Có thể làm những task đơn giản</span>
            </div>
            <div class="d-flex" style="gap: 20px">
                <p style="padding: 10px 15px; background-color: #90EE90">3</p>
                <span>Có thể làm được ngay</span>
            </div>
            <div class="d-flex" style="gap: 20px">
                <p style="padding: 10px 15px; background-color: #9ACD32">4</p>
                <span>Có kinh nghiệm</span>
            </div>
            <div class="d-flex" style="gap: 20px">
                <p style="padding: 10px 15px; background-color: #00BFFF">5</p>
                <span>Expert</span>
            </div>
        </div>
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @error('error')
            <div class="alert alert-danger">
                {{ $messages['error'] }}
            </div>
        @enderror
        <div class="card overflow-auto">
            <table id="example" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>User ID</th>
                        <th>Name</th>
                        @foreach ($skills as $skill)
                            <th style="transform:  translateX(0%) translateY(0%) rotate(-90deg)">
                                {{ $skill->name }}
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td></td>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            @foreach ($skills as $skill)
                                <td style="background-color: {{ $skill->getColorForLevel($user->id) }}">
                                    <select style="border: none; background: none; cursor: pointer"
                                        onchange="$('#{{ $user->id . 'a' . $skill->id }}').modal('show'); level{{ $user->id . 'c' . $skill->id }}()"
                                        id="{{ $user->id . 'c' . $skill->id }}" data-toggle="tooltip" data-placement="top"
                                        title="">
                                        <option selected>{{ $skill->getLatestUserLevel($user->id) }}</option>
                                        <option>-1</option>
                                        <option>0</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </td>
                                <div class="modal fade" id="{{ $user->id . 'a' . $skill->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Update Level</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <form action="{{ route('skill-user.store') }}"
                                                    id="{{ $user->id . '.' . $skill->id }}" method="post">
                                                    @csrf
                                                    <label>Skill up completion time(Month)</label>
                                                    <input type="text" name="time_skill_up" placeholder="Please wait..."
                                                        class="form-control">
                                                    <input type="hidden" name="skill_id" value="{{ $skill->id }}">
                                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                    <input type="hidden" name="level"
                                                        id="{{ $user->id . 'b' . $skill->id }}" value="">
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary"
                                                    onclick="document.getElementById({{ $user->id . '.' . $skill->id }}).submit();">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    function level{{ $user->id . 'c' . $skill->id }}() {
                                        var level = document.getElementById('{{ $user->id . 'c' . $skill->id }}').value;
                                        document.getElementById('{{ $user->id . 'b' . $skill->id }}').value = level;
                                    }

                                    $('#{{ $user->id . 'c' . $skill->id }}').hover(function(event) {
                                        $.ajax({
                                            Type: 'GET',
                                            url: '{{ route('show-level-history') }}',
                                            data: {
                                                user_id: {{ $user->id }},
                                                skill_id: {{ $skill->id }},
                                            },

                                            success: function(data) {
                                                for (var i = 0; i < data.skill_user.length; i++) {
                                                    var history = 'level ' + data.skill_user[i]['level'] + ' to ' + data.skill_user[i]['created_at'];
                                                    var a = history.concat(history);
                                                }
                                                    document.getElementById('{{ $user->id . 'c' . $skill->id }}').title = a;
                                            }
                                        })
                                    })
                                </script>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
