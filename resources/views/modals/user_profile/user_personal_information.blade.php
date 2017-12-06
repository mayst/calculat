<div id="info-popup" class="popup-info mfp-hide zoom-anim-dialog">

    <div class="popup-info-header">
        <h2>Information</h2>
    </div>

    <div class="popup-info-content">
        <div class="row">

            <div class="col-sm-4">
                <div class="tabs popup-tabs">
                    <a href="#popup-tab1" class="popup-tabs-btn active">Basic</a>
                    <a href="#popup-tab3" class="popup-tabs-btn">About</a>
                    <a href="#popup-tab6" class="popup-tabs-btn">Life Position</a>
                    <a href="#popup-tab2" class="popup-tabs-btn">Physique</a>
                    <a href="#popup-tab4" class="popup-tabs-btn">Hobby</a>
                    <a href="#popup-tab7" class="popup-tabs-btn">I`m Looking For</a>
                    <a href="#popup-tab5" class="popup-tabs-btn">Other</a>
                    <a href="#popup-tab8" class="popup-tabs-btn">Photos</a>
                </div>
            </div>

            <div class="col-sm-8">
                <div class="popup-tabs-content">

                    <form method="post" action="/save_profile/{{ $info->id }}" accept-charset="UTF-8" class="popup-info-form">

                        {{ csrf_field() }}

                        <div id="popup-tab1" class="popup-tab active">
                            <div class="form-group">
                                <label for="popup-info-name">Name:</label>
                                <input id="popup-info-name" type="text" name="name" class="form-controll" min="2" max="50" value="{{ $info->user->name }}" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label for="age">Age:</label>
                                <input type="date" id="age" value="{{ $info->age }}" name="age" class="form-controll datepicker">
                            </div>
                            <div class="form-group">
                                <label>Country:</label>
                                <select name="country" class="select">
                                    <option value="{{ $info->country }}" selected>{{ $info->country }}</option>
                                    <option value="Country 1">Ukraine</option>
                                    <option value="Country 2">Country 2</option>
                                    <option value="Country 3">Country 3</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>City:</label>
                                <select name="city" class="select">
                                    <option value="{{ $info->city }}" selected>{{ $info->city }}</option>
                                    <option value="City 1">City 1</option>
                                    <option value="City 2">City 2</option>
                                    <option value="City 3">City 3</option>
                                </select>
                            </div>
                        </div>

                        <div id="popup-tab2" class="popup-tab">
                            <div class="form-group">
                                <label for="height">Height:</label>
                                <input id="height" name="height" type="text" min="3" max="3" value="{{ $info->height }}" class="form-controll">
                            </div>
                            <div class="form-group">
                                <label for="weight">Weight:</label>
                                <input id="weight" name="weight" type="text" min="2" max="3" value="{{ $info->weight }}" class="form-controll">
                            </div>
                            <div class="form-group">
                                <label>Body type:</label>
                                <select name="body_type" class="select">
                                    <option value="{{ $info->body_type }}" selected>{{ $info->body_type }}</option>
                                    <option value="Thin">Average</option>
                                    <option value="Slim">Athletic</option>
                                    <option value="Thick">Slim</option>
                                    <option value="Full">Plump</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Hair color:</label>
                                <select name="hair_color" class="select">
                                    <option value="{{ $info->hair_color }}" selected>{{ $info->hair_color }}</option>
                                    <option value="Blonde">Blonde</option>
                                    <option value="Brown-haired">Brown-haired</option>
                                    <option value="Red-haired">Red-haired</option>
                                    <option value="Brunette">Brunette</option>
                                    <option value="Dyed">Dyed</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Eyes color:</label>
                                <select name="eyes_color" class="select">
                                    <option value="{{ $info->eyes_color }}" selected>{{ $info->eyes_color }}</option>
                                    <option value="Brown">Brown</option>
                                    <option value="Green">Green</option>
                                    <option value="Gray">Gray</option>
                                    <option value="Blue">Blue</option>
                                    <option value="Black">Black</option>
                                    <option value="Yellow">Yellow</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Skin color:</label>
                                <select name="skin_color" class="select">
                                    <option value="{{ $info->skin_color }}" selected>{{ $info->skin_color }}</option>
                                    <option value="Skin color 1">Light</option>
                                    <option value="Skin color 2">Normal Tan</option>
                                    <option value="Skin color 3">Dark</option>
                                </select>
                            </div>
                        </div>

                        <div id="popup-tab3" class="popup-tab">
                            <div class="form-group small-padding">
                                <label>Job:</label>
                                <div class="input-box">
                                    <input type="text" id="job" value="{{ $info->job }}" name="job" autocomplete="off" class="form-controll">
                                </div>
                            </div>
                            <div class="form-group small-padding">
                                <label>Position:</label>
                                <div class="input-box">
                                    <input type="text" id="position" value="{{ $info->position }}" name="position" autocomplete="off" class="form-controll">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>About me:</label>
                                <div class="textarea-box">
                                    <textarea class="form-controll" name="about_me">{{ $info->about_me }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div id="popup-tab4" class="popup-tab">
                            <div class="form-group">
                                <label>Hobby:</label>
                                <div class="wrapper-city">
                                    <div class="input-box">
                                        <input type="text" id="hobby" name="hobby" autocomplete="off" class="form-controll hobby">
                                        <ul id="hobby-result-list" class="result-list"></ul>
                                        <div class="add-btn" id="add-hobby">Add</div>
                                    </div>
                                </div>
                            </div>
                            <div id="hobby-tags" class="tags">
                                @php preg_match_all('/\w+/', $info->hobby, $hobbies); @endphp
                                @foreach($hobbies[0] as $hobby)
                                    <p class="tag">{{ $hobby }}<a class="delete-el" href="#">X</a></p>
                                @endforeach
                            </div>

                            <div class="form-group">
                                <label>Love too:</label>
                                <div class="wrapper-city">
                                    <div class="input-box">
                                        <input type="text" id="love_too" name="love_too" autocomplete="off" class="form-controll love_too">
                                        <ul id="love_too-result-list" class="result-list"></ul>
                                        <div class="add-btn" id="add-love">Add</div>
                                    </div>
                                </div>
                            </div>
                            <div id="love_too-tags" class="tags">
                                @php preg_match_all('/\w+/', $info->love_too, $loves); @endphp
                                @foreach($loves[0] as $love)
                                    <p class="tag">{{ $love }}<a class="delete-el" href="#">X</a></p>
                                @endforeach
                            </div>
                        </div>

                        <div id="popup-tab5" class="popup-tab">
                            <div class="form-group small-padding">
                                <label>I live:</label>
                                <select name="i_live" class="select">
                                    <option value="{{ $info->i_live }}" selected>{{ $info->i_live }}</option>
                                    <option value="Own Apartment">Own apartment</option>
                                    <option value="Private house">Private house</option>
                                    <option value="Rented accommodation">Rented accommodation</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Education:</label>
                                <div class="input-box">
                                    <input type="text" id="education" name="education" value="{{ $info->education }}" autocomplete="off" class="form-controll education">
                                    <ul id="education-result-list" class="result-list"></ul>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Marital status:</label>
                                <select name="marital_status" class="select">
                                    <option value="{{ $info->marital_status }}" selected>{{ $info->marital_status }}</option>
                                    <option value="Married">Married</option>
                                    <option value="Actively searching">Actively searching</option>
                                    <option value="Divorced">Divorced</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Chilrden:</label>
                                <select name="chilrden" class="select">
                                    <option value="{{ $info->chilrden }}" selected>{{ $info->chilrden }}</option>
                                    <option value="Have">Have</option>
                                    <option value="Haven`t">Haven`t</option>
                                </select>
                            </div>
                        </div>

                        <div id="popup-tab6" class="popup-tab">
                            <div class="form-group">
                                <label>Attitude to alcohol:</label>
                                <select name="attitude_to_alcohol" class="select">
                                    <option value="{{ $info->attitude_to_alcohol }}" selected>{{ $info->attitude_to_alcohol }}</option>
                                    <option value="Negative">Negative</option>
                                    <option value="Compromise">Compromise</option>
                                    <option value="Neutral">Neutral</option>
                                    <option value="Positive">Positive</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Attitude to smoking:</label>
                                <select name="attitude_to_smoking" class="select">
                                    <option value="{{ $info->attitude_to_smoking }}" selected>{{ $info->attitude_to_smoking }}</option>
                                    <option value="Negative">Negative</option>
                                    <option value="Compromise">Compromise</option>
                                    <option value="Neutral">Neutral</option>
                                    <option value="Positive">Positive</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Religious views:</label>
                                <select name="religious_views" class="select">
                                    <option value="{{ $info->religious_views }}" selected>{{ $info->religious_views }}</option>
                                    <option value="Judaism">Judaism</option>
                                    <option value="Orthodoxy">Orthodoxy</option>
                                    <option value="Catholicism">Catholicism</option>
                                    <option value="Protestantism">Protestantism</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Buddhism">Buddhism</option>
                                    <option value="Confucianism">Confucianism</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Zodiac:</label>
                                <select name="zodiac" class="select">
                                    <option value="{{ $info->zodiac }}" selected>{{ $info->zodiac }}</option>
                                    <option value="Aquarius">Aquarius</option>
                                    <option value="Pisces">Pisces</option>
                                    <option value="Aries">Aries</option>
                                    <option value="Taurus">Taurus</option>
                                    <option value="Gemini">Gemini</option>
                                    <option value="Cancer">Cancer</option>
                                    <option value="Leo">Leo</option>
                                    <option value="Virgo">Virgo</option>
                                    <option value="Libra">Libra</option>
                                    <option value="Scorpio">Scorpio</option>
                                    <option value="Sagittarius">Sagittarius</option>
                                    <option value="Capricorn">Capricorn</option>
                                </select>
                            </div>
                        </div>

                        <div id="popup-tab7" class="popup-tab">
                            <div class="form-group">
                                <label>My desire:</label>
                                <div class="textarea-box">
                                    <textarea class="form-controll" name="my_desire">{{ $info->my_desire }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>My priorities:</label>
                                <select name="my_priorities" class="select">
                                    <option value="{{ $info->my_priorities }}" selected>{{ $info->my_priorities }}</option>
                                    <option value="Communication">Communication</option>
                                    <option value="Family and kids">Family and kids</option>
                                    <option value="Traveling">Traveling</option>
                                    <option value="Friendship">Friendship</option>
                                </select>
                            </div>
                        </div>

                        <div class="submit-box" id="user-personal-info-submit-box">
                            <button type="submit">submit</button>
                        </div>

                    </form>

                    <!-- **** -->

                    <div id="popup-tab8" class="popup-tab drop-box">
                        <h1>Your gallery</h1>
                        @foreach($gallery as $photo)
                            <div style="float: left;
                                        position: relative;
                                        height: 172px;
                                        width: 182px;
                                        border: 4px solid #fff;
                                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                                        background-color: #fff;
                                        background-position: center;
                                        background-size: cover;
                                        border-radius: 4px;
                                        margin: 5px;
                                        overflow: hidden;">
                                <img style="height: 100%; width: 100%;" src="/images/upload_gallery/{{ $photo->name }}" alt="">
                                <div class="delete-gallery-image" style="display: block;
                                                position: absolute;
                                                z-index: 9999;
                                                padding: 5px;
                                                width: 100%;
                                                background: rgba(0, 0, 0, 0.7);
                                                color: #fff;
                                                font-size: 1em;
                                                font-weight: 700;
                                                border: none;
                                                border-radius: 0;
                                                outline: none;
                                                bottom: 0;
                                                text-align: center;
                                                text-decoration: none;
                                                cursor: pointer;" data-delete-id="{{ $photo->name }}">Remove image</div>
                            </div>
                        @endforeach
                        <div style="clear: both;"></div>

                        <div id="drop-files" class="drop-files" ondragover="return false">
                            <p>Drag the images here or select them from your computer</p>

                            <div class="select-file-button-box">
                                <button type="button" id="select-file-for-gallery-btn">select files</button>
                            </div>

                            <form id="frm" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="file" id="input-file" name="gallery[]" class="uploadbtn" multiple>
                            </form>

                        </div>

                        <div class="uploaded-holder">
                            <div class="dropped-files">
                                <div class="upload-button">
                                    <div class="result">
                                        <p class="quantity-of-file">0 Files</p>
                                        <button type="button" id="upload-all-image-on-server" class="upload">Upload</button>
                                        <button type="button" id="remove-all-image" class="delete">Remove all</button>
                                    </div>
                                    <div class="loading">
                                        <div class="loading-bar"></div>
                                    </div>
                                </div>
                                <div class="uploaded-images-box"></div>
                            </div>
                        </div>

                    </div>

                    <!-- **** -->

                </div>
            </div>

        </div>
    </div>

</div>