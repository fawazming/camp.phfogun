
    <!-- Step 3: Registration form (post-payment) -->
    <section id="step-register" class="card bg-white p-5 rounded-2xl mt-6">
      <h2 class="text-xl font-semibold">Complete Registration</h2>
      <p class="text-sm text-gray-500">Provide the details below to generate your camp ID.</p>

      <form id="registrationForm" method="POST" action=<?=base_url("registration")?> class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-3">
        <div>
          <label class="text-xs font-medium text-gray-600">First name</label>
          <input id="firstname" name="fname" required class="mt-1 w-full rounded-lg border-gray-700 p-3 border-2" />
        </div>

        <div>
          <label class="text-xs font-medium text-gray-600">Surname</label>
          <input id="lastname" name="lname" required class="mt-1 w-full rounded-lg border-gray-700 p-3 border-2" />
        </div>

        <div>
          <label class="text-xs font-medium text-gray-600">Gender</label>
          <select id="gender" name="gender" required class="mt-1 w-full rounded-lg border-gray-700 p-3 border-2">
            <option value="">Select a gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
          </select>
        </div>

        <div>
          <label class="text-xs font-medium text-gray-600">Local Branch</label>
          <select id="branch" name="lb" required class="mt-1 w-full rounded-lg border-gray-700 p-3 border-2">
          <option value="">Select a Local Branch</option>
            <option value="Egba">Egba</option>
            <option value="Remo">Remo</option>
            <option value="Ijebu">Ijebu</option>
            <option value="Adoodo">Ado-Odo</option>
            <option value="Yewa">Yewa</option>
            <option value="others">Others</option>
          </select>
        </div>

        <div>
          <label class="text-xs font-medium text-gray-600">Which Islamic org. do you belong to?</label>
          <select id="org" name="org" required class="mt-1 w-full rounded-lg border-gray-700 p-3 border-2">
            <option value="">Choose an Organisation</option>
            <option value="phf">PHF</option>
            <option value="tyma">TYMa</option>
            <option value="mssn">MSSN</option>
            <option value="nasfat">NASFAT</option>
            <option value="aud">Ansaru-Deen</option>
            <option value="tmc">TMC</option>
            <option value="others">Others</option>
          </select>
        </div>

        <div>
          <label class="text-xs font-medium text-gray-600">Phone</label>
          <input id="phone" required name="phone" class="mt-1 w-full rounded-lg border-gray-700 p-3 border-2" placeholder="0803xxxxxxx" />
        </div>

        <div>
          <label class="text-xs font-medium text-gray-600">Email</label>
          <input id="email" required name="email" readonly value="<?=$email?>" class="mt-1 w-full rounded-lg border-gray-700 p-3 border-2" placeholder="0803xxxxxxx" />
        </div>
            <input type="hidden" name="category" id="category" required value="<?=$category?>">
            <!-- <input type="hidden" name="category" id="category" required value="professionals"> -->
            <input type="hidden" name="txn" id="txn" required value="<?=$ref?>-<?=$ticket?>">
            <input type="hidden" name="ticket" id="txn" required value="<?=$ticket?>">

        <div>
          <label id="sch-label" class="text-xs font-medium text-gray-600">School / Institution</label>
          <input id="school" name="school" class="mt-1 w-full rounded-lg border-gray-700 p-3 border-2" />
        </div>

        <div id="level-wrapper" class="mt-4">
          <label id="level-label" class="text-xs font-medium text-gray-600">Level / Class</label>
          <div id="level-field" class="mt-1 border-2"></div>
        </div>

        <div class="sm:col-span-2 flex gap-2 mt-2">
          <button type="submit" class="ml-auto px-5 py-3 bg-indigo-600 text-white rounded-lg">Complete Registration</button>
        </div>
      </form>
    </section>


<script>
  const categoryEl = document.getElementById("category");
  const levelField = document.getElementById("level-field");
  const levelLabel = document.getElementById("level-label");
  const schLabel = document.getElementById("sch-label");

    const value = categoryEl.value;
    levelField.innerHTML = ""; // clear previous field
    

    if (value === "secondary_school_student") {
      const select = document.createElement("select");
      select.name = "level";
      select.id = "level";
      select.className = "mt-1 w-full rounded-lg border-gray-700 p-3";
      levelLabel.textContent = "Class in School";
      schLabel.textContent = "Name of your school";

      ["JS1", "JS2", "JS3", "SS1", "SS2", "SS3"].forEach(lvl => {
        const opt = document.createElement("option");
        opt.value = lvl;
        opt.textContent = lvl;
        select.appendChild(opt);
      });

      levelField.appendChild(select);

    } else if (value === "school_leaver") {
      const input = document.createElement("input");
      input.type = "text";
      input.name = "level";
      input.id = "level";
      schLabel.textContent = "Where do you currently work?";

      levelLabel.textContent = "What are you engaged with";
      input.placeholder = "As a school leaver, I'm currently engaged with...";
      input.className = "mt-1 w-full rounded-lg border-gray-700 p-3";
      levelField.appendChild(input);

    } else if (value === "undergraduate") {
      const select = document.createElement("select");
      select.name = "level";
      select.id = "level";
      select.className = "mt-1 w-full rounded-lg border-gray-700 p-3";
      levelLabel.textContent = "Level in Institution"
      schLabel.textContent = "Institution Name";

      [" ", "100L", "200L", "300L", "400L", "500L", "600L"].forEach(lvl => {
        const opt = document.createElement("option");
        opt.value = lvl;
        opt.textContent = lvl;
        select.appendChild(opt);
      });

      levelField.appendChild(select);

    } else if (value === "professionals") {
      const input = document.createElement("input");
      input.type = "text";
      input.name = "level";
      input.id = "level";
      levelLabel.textContent = "Current job role"
      schLabel.textContent = "Current place of work?";
      
      input.placeholder = "Current job role...";
      input.className = "mt-1 w-full rounded-lg border-gray-700 p-3";
      levelField.appendChild(input);
    }
</script>

