<?php
class M_frontend_caller
{
    public function QUICK_INDEX(): array
    {
        // Return value: array of method names ranked from common view tasks to less common tasks.
        return [
            'PHP_FOREACH_GENERATE_OPTIONS',
            'PHP_PRINT_VALUES',
            'OUTPUT_ESCAPE_RULES',
            'FORM_INPUT_TYPES_OVERVIEW',
            'DROPDOWN_PHP_FOR_LOOP',
            'DROPDOWN_PHP_FOREACH_LOOP',
            'RADIO_BUTTONS_PHP_LOOP',
            'RADIO_BUTTONS_PHP_FOREACH_LOOP',
            'DATE_INPUT_TYPES',
            'PHP_PRINT_CONTROLLER_VALUES',
            'PHP_FOREACH_GENERATE_TABLE',
            'JS_PRINT_VALUES_TO_DOM',
            'JS_SELECTORS_ID_AND_QUERY',
            'JS_BIND_INPUT_VALUES',
            'AJAX_POST_FETCH_JSON',
            'AJAX_GET_FETCH_RENDER',
            'PHP_TO_JS_JSON_DATA',
            'DYNAMIC_FORM_FIELDS',
            'FORM_VALIDATION_REQUIRED_PATTERN',
        ];
    }

    public function PHP_FOREACH_GENERATE_OPTIONS(): string
    {
        // Beginner view pattern: build a dropdown from a PHP array.
        // Step 1: create an array of values.
        // Step 2: loop through values with foreach.
        // Step 3: print one <option> for each item.
        // Keyword note: foreach repeats a block for each array item.

        $snippet = <<<'HTML'
<?php
$categories = ['Tech', 'Business', 'Design'];
?>
<select name="category" id="category">
    <?php foreach ($categories as $category): ?>
        <option value="<?php echo $category; ?>">
            <?php echo $category; ?>
        </option>
    <?php endforeach; ?>
</select>
HTML;

        // Return value: snippet string; output is a dropdown where each array item becomes one option row.
        return $snippet;
    }

    public function PHP_PRINT_VALUES(): string
    {
        // Beginner print pattern: show basic text and numbers from PHP variables.
        // Keyword note: echo prints variable values into the page.
        // Basic rule: direct echo is fine for constants or values fully controlled by your own code.

        $snippet = <<<'HTML'
<?php
$userName = 'Asha';
$points = 245;
?>
<p>User: <?php echo $userName; ?></p>
<p>Points: <?php echo (int)$points; ?></p>
HTML;

        // Return value: snippet string; output is two paragraphs that print a text value and a numeric value.
        return $snippet;
    }

    public function OUTPUT_ESCAPE_RULES(): string
    {
        // Practical rule for output:
        // 1) Hardcoded/internal trusted values can be printed directly.
        // 2) User input, request data, or database text should be escaped before printing.
        // Keyword note: htmlspecialchars converts special characters so HTML is shown as text, not executed.

        $snippet = <<<'HTML'
<?php
$trustedTitle = 'My Dashboard';
$nameFromUser = $data['name'] ?? '';
?>

<!-- Direct print is okay for trusted constants -->
<h2><?php echo $trustedTitle; ?></h2>

<!-- Escaped print is safer for dynamic/user text -->
<p><?php echo htmlspecialchars($nameFromUser); ?></p>
HTML;

        // Return value: snippet string; output demonstrates both direct printing and escaped printing in one place.
        return $snippet;
    }

    public function FORM_INPUT_TYPES_OVERVIEW(): string
    {
        // Shows common HTML form input types in one basic example.
        // Use this as a quick reference for which type to pick.
        // Keyword note: the type attribute controls how each input behaves in the browser.

        $snippet = <<<'HTML'
<form method="post" action="/profile/save-basic">
    <label>Text</label>
    <input type="text" name="full_name" />

    <label>Email</label>
    <input type="email" name="email" />

    <label>Password</label>
    <input type="password" name="password" />

    <label>Number</label>
    <input type="number" name="age" min="1" max="120" />

    <label>Phone</label>
    <input type="tel" name="phone" />

    <label>Website</label>
    <input type="url" name="website" />

    <label>Date</label>
    <input type="date" name="birth_date" />

    <label>Time</label>
    <input type="time" name="meeting_time" />

    <label>Date and Time</label>
    <input type="datetime-local" name="appointment" />

    <label>Color</label>
    <input type="color" name="theme_color" />

    <label>Range</label>
    <input type="range" name="rating" min="1" max="10" />

    <label>File</label>
    <input type="file" name="resume" />

    <input type="hidden" name="form_source" value="basic_form" />

    <button type="submit">Submit</button>
</form>
HTML;

        // Return value: snippet string; output is one form showing many commonly used input types.
        return $snippet;
    }

    public function DROPDOWN_PHP_FOR_LOOP(): string
    {
        // Builds a dropdown dynamically using a PHP for loop.
        // Step 1: define values in an array.
        // Step 2: loop by index.
        // Step 3: print each item as an option.
        // Keyword note: for loop is useful when you want index-based control while rendering.

        $snippet = <<<'HTML'
<?php
$departments = ['IT', 'HR', 'Finance', 'Marketing'];
?>

<label for="department">Department</label>
<select id="department" name="department" required>
    <option value="">Select department</option>
    <?php for ($i = 0; $i < count($departments); $i++): ?>
        <option value="<?php echo $departments[$i]; ?>">
            <?php echo $departments[$i]; ?>
        </option>
    <?php endfor; ?>
</select>
HTML;

        // Return value: snippet string; output is a dynamic dropdown generated from a PHP array with a for loop.
        return $snippet;
    }

    public function DROPDOWN_PHP_FOREACH_LOOP(): string
    {
        // Builds the same dropdown dynamically using foreach.
        // Step 1: define values in an array.
        // Step 2: loop each value directly.
        // Step 3: print one option for each loop item.
        // Keyword note: foreach is shorter and cleaner when index numbers are not needed.

        $snippet = <<<'HTML'
<?php
$departments = ['IT', 'HR', 'Finance', 'Marketing'];
?>

<label for="department2">Department</label>
<select id="department2" name="department" required>
    <option value="">Select department</option>
    <?php foreach ($departments as $department): ?>
        <option value="<?php echo $department; ?>">
            <?php echo $department; ?>
        </option>
    <?php endforeach; ?>
</select>
HTML;

        // Return value: snippet string; output is a dynamic dropdown generated from a PHP array with foreach.
        return $snippet;
    }

    public function RADIO_BUTTONS_PHP_LOOP(): string
    {
        // Builds radio buttons dynamically from an array in PHP.
        // Step 1: create a list of choices.
        // Step 2: loop and print one radio input per choice.
        // Step 3: optionally mark one option as checked.
        // Keyword note: type="radio" allows only one selected value per name group.

        $snippet = <<<'HTML'
<?php
$levels = ['Beginner', 'Intermediate', 'Advanced'];
$selectedLevel = $data['level'] ?? 'Intermediate';
?>

<fieldset>
    <legend>Skill Level</legend>
    <?php for ($i = 0; $i < count($levels); $i++): ?>
        <?php $level = $levels[$i]; ?>
        <label>
            <input
                type="radio"
                name="level"
                value="<?php echo $level; ?>"
                <?php echo $selectedLevel === $level ? 'checked' : ''; ?>
            />
            <?php echo $level; ?>
        </label>
    <?php endfor; ?>
</fieldset>
HTML;

        // Return value: snippet string; output is one radio group with options generated by loop.
        return $snippet;
    }

    public function RADIO_BUTTONS_PHP_FOREACH_LOOP(): string
    {
        // Builds the same radio group using foreach.
        // Step 1: define choices in an array.
        // Step 2: loop each choice with foreach.
        // Step 3: print checked attribute for the selected value.
        // Keyword note: foreach makes value-based loops easier to read for form rendering.

        $snippet = <<<'HTML'
<?php
$levels = ['Beginner', 'Intermediate', 'Advanced'];
$selectedLevel = $data['level'] ?? 'Intermediate';
?>

<fieldset>
    <legend>Skill Level</legend>
    <?php foreach ($levels as $level): ?>
        <label>
            <input
                type="radio"
                name="level"
                value="<?php echo $level; ?>"
                <?php echo $selectedLevel === $level ? 'checked' : ''; ?>
            />
            <?php echo $level; ?>
        </label>
    <?php endforeach; ?>
</fieldset>
HTML;

        // Return value: snippet string; output is one radio group where each option is rendered with foreach.
        return $snippet;
    }

    public function DATE_INPUT_TYPES(): string
    {
        // Shows how to collect date-related values from users.
        // Includes date, time, datetime-local, month, and week types.
        // Keyword note: min and max can restrict the allowed date range in browser UI.

        $snippet = <<<'HTML'
<form method="post" action="/events/save-date-info">
    <label for="event_date">Event Date</label>
    <input id="event_date" type="date" name="event_date" min="2026-01-01" max="2027-12-31" required />

    <label for="event_time">Event Time</label>
    <input id="event_time" type="time" name="event_time" required />

    <label for="event_datetime">Event Date and Time</label>
    <input id="event_datetime" type="datetime-local" name="event_datetime" required />

    <label for="billing_month">Billing Month</label>
    <input id="billing_month" type="month" name="billing_month" />

    <label for="sprint_week">Sprint Week</label>
    <input id="sprint_week" type="week" name="sprint_week" />

    <button type="submit">Save Dates</button>
</form>
HTML;

        // Return value: snippet string; output is a form that captures date and time values in multiple formats.
        return $snippet;
    }

    public function PHP_PRINT_CONTROLLER_VALUES(): string
    {
        // Shows the simplest way to print values passed by a controller using the $data array.
        // Step 1: read keys from $data.
        // Step 2: use ?? fallback to avoid undefined-key errors.
        // Keyword note: ?? returns the right side when the left side is not set.

        $snippet = <<<'HTML'
<h2><?php echo $data['title'] ?? 'Dashboard'; ?></h2>
<p>Welcome, <?php echo $data['user']['name'] ?? 'Guest'; ?></p>
<ul>
    <?php foreach (($data['notifications'] ?? []) as $item): ?>
        <li><?php echo $item['message'] ?? ''; ?></li>
    <?php endforeach; ?>
</ul>
HTML;

        // Return value: snippet string; output is a heading, a welcome line, and a list from controller-provided data.
        return $snippet;
    }

    public function PHP_FOREACH_GENERATE_TABLE(): string
    {
        // Builds a basic HTML table from backend rows.
        // Step 1: loop through $data['users'].
        // Step 2: print one <tr> for each user.
        // Keyword note: foreach is the common loop for repeated HTML in PHP views.

        $snippet = <<<'HTML'
<table border="1" cellpadding="8">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach (($data['users'] ?? []) as $row): ?>
            <tr>
                <td><?php echo $row['name'] ?? ''; ?></td>
                <td><?php echo $row['email'] ?? ''; ?></td>
                <td><?php echo $row['role'] ?? ''; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
HTML;

        // Return value: snippet string; output is a table with one row per user in $data['users'].
        return $snippet;
    }

    public function JS_PRINT_VALUES_TO_DOM(): string
    {
        // Shows how JavaScript prints values into the page and console.
        // Step 1: create a JS object.
        // Step 2: get an element by id.
        // Step 3: print values into that element.
        // Keyword note: textContent writes plain text to the DOM.

        $snippet = <<<'HTML'
<div id="summary"></div>
<script>
const student = { name: 'Nimal', year: 2026, score: 88 };
const summary = document.getElementById('summary');
summary.textContent = 'Name: ' + student.name + ', Year: ' + student.year + ', Score: ' + student.score;
console.log('Student object:', student);
</script>
HTML;

        // Return value: snippet string; output is a formatted summary line in the DOM plus a console debug entry.
        return $snippet;
    }

    public function JS_SELECTORS_ID_AND_QUERY(): string
    {
        // Shows how to select elements using getElementById and querySelector.
        // Step 1: select by id when you know one unique id.
        // Step 2: select by CSS selector for class, attribute, or tag patterns.
        // Keyword note: getElementById is id-specific, querySelector uses CSS selector syntax.

        $snippet = <<<'HTML'
<div id="statusBox">Waiting...</div>
<input id="studentName" type="text" value="Nimal" />
<button class="save-btn" type="button">Save</button>

<script>
const statusBox = document.getElementById('statusBox');
const studentNameInput = document.getElementById('studentName');
const saveBtn = document.querySelector('.save-btn');

statusBox.textContent = 'Elements selected';

saveBtn.addEventListener('click', function () {
    const currentName = studentNameInput.value;
    statusBox.textContent = 'Saved name: ' + currentName;
    console.log('Button selected by querySelector:', saveBtn);
});
</script>
HTML;

        // Return value: snippet string; output is a small UI that demonstrates both selector styles and event handling.
        return $snippet;
    }

    public function JS_BIND_INPUT_VALUES(): string
    {
        // Shows two-way value binding in plain JavaScript.
        // Step 1: fill input fields from an object (simulate controller/API data).
        // Step 2: read values back from inputs when submitting.
        // Keyword note: .value reads or writes the value of form controls.

        $snippet = <<<'HTML'
<form id="profileFormSimple" action="#" method="post">
    <label for="full_name">Full Name</label>
    <input id="full_name" name="full_name" type="text" />

    <label for="email">Email</label>
    <input id="email" name="email" type="email" />

    <button type="submit">Read Values</button>
</form>

<pre id="payloadPreview"></pre>

<script>
const existingUser = {
    full_name: 'Asha Perera',
    email: 'asha@example.com'
};

document.getElementById('full_name').value = existingUser.full_name;
document.getElementById('email').value = existingUser.email;

const profileFormSimple = document.getElementById('profileFormSimple');
const payloadPreview = document.getElementById('payloadPreview');

profileFormSimple.addEventListener('submit', function (event) {
    event.preventDefault();

    const payload = {
        full_name: document.getElementById('full_name').value,
        email: document.getElementById('email').value
    };

    payloadPreview.textContent = JSON.stringify(payload, null, 2);
});
</script>
HTML;

        // Return value: snippet string; output pre-fills inputs, then reads and prints current values as JSON.
        return $snippet;
    }

    public function AJAX_POST_FETCH_JSON(): string
    {
        // Sends a POST AJAX request with fetch and handles JSON response.
        // Step 1: read form values and build payload.
        // Step 2: send POST with JSON body.
        // Step 3: parse response and render message in the DOM.
        // Keyword note: fetch returns a Promise; await response.json() parses JSON body.

        $snippet = <<<'HTML'
<form id="profileAjaxForm" action="#" method="post">
    <label for="ajax_name">Name</label>
    <input id="ajax_name" name="name" type="text" required />

    <label for="ajax_email">Email</label>
    <input id="ajax_email" name="email" type="email" required />

    <button type="submit">Send POST</button>
</form>

<p id="postMessage"></p>

<script>
const profileAjaxForm = document.getElementById('profileAjaxForm');
const postMessage = document.getElementById('postMessage');

profileAjaxForm.addEventListener('submit', async function (event) {
    event.preventDefault();

    const payload = {
        name: document.getElementById('ajax_name').value,
        email: document.getElementById('ajax_email').value
    };

    try {
        const response = await fetch('/api/profile/update', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(payload)
        });

        const result = await response.json();
        postMessage.textContent = result.message || 'Profile saved successfully';
    } catch (error) {
        postMessage.textContent = 'POST request failed';
        console.error(error);
    }
});
</script>
HTML;

        // Return value: snippet string; output submits form data via POST AJAX and shows server response text.
        return $snippet;
    }

    public function AJAX_GET_FETCH_RENDER(): string
    {
        // Sends a GET AJAX request, receives JSON list results, and renders rows into the page.
        // Step 1: bind search input value into query params.
        // Step 2: call API with fetch GET.
        // Step 3: render returned users into a list.
        // Keyword note: encodeURIComponent safely places input values into URL query parameters.

        $snippet = <<<'HTML'
<label for="searchKeyword">Search Users</label>
<input id="searchKeyword" type="text" placeholder="Type a name" />
<button id="loadUsersBtn" type="button">Load Users</button>

<ul id="usersResult"></ul>

<script>
const loadUsersBtn = document.getElementById('loadUsersBtn');
const usersResult = document.getElementById('usersResult');

loadUsersBtn.addEventListener('click', async function () {
    const keyword = document.getElementById('searchKeyword').value.trim();
    const url = '/api/users?keyword=' + encodeURIComponent(keyword);

    usersResult.innerHTML = '<li>Loading...</li>';

    try {
        const response = await fetch(url, {
            method: 'GET'
        });

        const data = await response.json();
        const users = data.users || [];

        usersResult.innerHTML = '';

        if (users.length === 0) {
            usersResult.innerHTML = '<li>No users found</li>';
            return;
        }

        users.forEach(function (user) {
            const li = document.createElement('li');
            li.textContent = user.name + ' - ' + user.email;
            usersResult.appendChild(li);
        });
    } catch (error) {
        usersResult.innerHTML = '<li>GET request failed</li>';
        console.error(error);
    }
});
</script>
HTML;

        // Return value: snippet string; output fetches filtered users and renders each result as a list item.
        return $snippet;
    }

    public function PHP_TO_JS_JSON_DATA(): string
    {
        // Passes PHP array data to JavaScript in the easiest way.
        // Keyword note: json_encode turns PHP arrays into valid JSON for browser-side code.

        $snippet = <<<'HTML'
<script>
const chartData = <?php echo json_encode($data['chart'] ?? [], JSON_UNESCAPED_SLASHES); ?>;
console.log('Chart data from controller:', chartData);
</script>
HTML;

        // Return value: snippet string; output is a JavaScript variable initialized from controller-side PHP data.
        return $snippet;
    }

    public function DYNAMIC_FORM_FIELDS(): string
    {
        // Creates and removes repeated form fields dynamically.
        // Step 1: user clicks Add Skill.
        // Step 2: JavaScript appends a new input row.
        // Step 3: user can remove any row.
        // Keyword note: appendChild inserts new elements into the page.

        $snippet = <<<'HTML'
<form id="skillForm" method="post" action="/profile/save-skills">
    <div id="skillFields">
        <div class="skill-row">
            <input type="text" name="skills[]" required pattern="^[A-Za-z ]{2,40}$" placeholder="Enter skill" />
        </div>
    </div>

    <button type="button" id="addSkillBtn">Add Skill</button>
    <button type="submit">Save</button>
</form>

<script>
const skillFields = document.getElementById('skillFields');
const addSkillBtn = document.getElementById('addSkillBtn');

addSkillBtn.addEventListener('click', function () {
    const row = document.createElement('div');
    row.className = 'skill-row';
    row.innerHTML = '<input type="text" name="skills[]" required pattern="^[A-Za-z ]{2,40}$" placeholder="Enter skill" /> <button type="button" class="remove-skill">Remove</button>';
    skillFields.appendChild(row);
});

skillFields.addEventListener('click', function (event) {
    if (event.target.classList.contains('remove-skill')) {
        event.target.closest('.skill-row').remove();
    }
});
</script>
HTML;

        // Return value: snippet string; output is a form where users can add and remove repeated input rows.
        return $snippet;
    }

    public function FORM_VALIDATION_REQUIRED_PATTERN(): string
    {
        // Demonstrates simple form validation.
        // HTML handles required fields and regex patterns.
        // JavaScript checks the full form before submit and shows browser messages.
        // Keyword note: checkValidity returns true only if all field rules pass.

        $snippet = <<<'HTML'
<form id="registerForm" method="post" action="/signup/submit" novalidate>
    <label for="full_name">Full Name</label>
    <input id="full_name" name="full_name" type="text" required pattern="^[A-Za-z ]{3,60}$" />

    <label for="email">Email</label>
    <input id="email" name="email" type="email" required />

    <label for="phone">Phone</label>
    <input id="phone" name="phone" type="text" required pattern="^[0-9]{10}$" />

    <button type="submit">Register</button>
</form>

<script>
const registerForm = document.getElementById('registerForm');

registerForm.addEventListener('submit', function (event) {
    if (!registerForm.checkValidity()) {
        event.preventDefault();
        registerForm.reportValidity();
    }
});
</script>
HTML;

        // Return value: snippet string; output is a form that enforces required fields and pattern matching before submit.
        return $snippet;
    }
}
