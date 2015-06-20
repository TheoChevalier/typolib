<form id="mainform">


		<h2>Summary</h2>

			<p class="user-guide-content">
			<div id="summary">
				<div id="summary-content">
					<ul>
						<li><a href="#rule-editor-adding">Rules editor (Adding a new rule)</a></li>
						<ul>
							<li><a href="#replace-with-rule">Replace with rule</a></li>
							<li><a href="#plural-separator-rule">Plural separator rule</a></li>
							<li><a href="#ignore-variable-rule">Ignore variable rule</a></li>
							<li><a href="#quotation-marks-rule">Quotation marks rule</a></li>
							<li><a href="#check-before-rule">Check before rule</a></li>
							<li><a href="#check-after-rule">Check after rule</a></li>
						</ul>
						<li><a href="#rule-editor-editing">Rules editor (Editing rules and exceptions)</a></li>
						<li><a href="#check-text">Check text</a></li>
						<li><a href="#special-characters">Special characters</a></li>
					</ul>
				</p>
			</div>
		</div>

	<br/><br/><br/><br/>

	<div id="rule-editor-adding">
	<h2>Rules editor (Adding a new rule)</h2>

		<div id="replace-with-rule">
			<h3>“Replace [...] with [...]” rule: </h3>
				<p class="user-guide-content">
					For this rule type, you have to enter after “Replace” the character or string you want to search and be replaced in your text. Then, you have to enter after “with” the substitution character or string.
					<br/><br/>
					Example in Typolib’: <br/>
					<img src="/img/user-guide-screens/replace_with.PNG" alt="Replace with rule example" height="" width="600px" border=1 border-color="white" class="user-guide-image">
				</p>
		</div>

		<br/><br/>

		<div id="plural-separator-rule">
			<h3>“Plural separator [...]” rule: </h3>
				<p class="user-guide-content">
					This rule type is dedicated to localization formats relying on specific character to separate plurals in a string.<br/>
					For instance: “Fenêtre partagée avec #1 onglet;Fenêtres partagées avec #1 onglets”
					<br/><br/>
					Example in Typolib’: <br/>
					<img src="/img/user-guide-screens/plural_separator.PNG" alt="Plural separator rule example" height="" width="400px" border=1 border-color="white" class="user-guide-image">
				</p>
		</div>

		<br/><br/>

		<div id="ignore-variable-rule">
			<h3>“Ignore variable [...]” rule: </h3>
				<p class="user-guide-content">
					For this rule type, you have to enter variables to ignore which are used in your files.
					<br/><br/>
					Example in Typolib’: <br/>
					<img src="/img/user-guide-screens/ignore_variable.PNG" alt="Ignore variable rule example" height="" width="400px" border=1 border-color="white" class="user-guide-image">
				</p>
		</div>

		<br/><br/>

		<div id="quotation-marks-rule">
			<h3>“Quotation mark [...] [...]” rule: </h3>
				<p class="user-guide-content">
					For this rule type, you have to enter the opening and the closing quotation mark to use.<br/>
					You don’t have to enter spaces after the opening quotation mark and before the closing quotation mark.
					<br/><br/>
					Example in Typolib’: <br/>
					<img src="/img/user-guide-screens/quotation_marks.PNG" alt="Quotation marks rule example" height="" width="400px" border=1 border-color="white" class="user-guide-image">
				</p>
		</div>

		<br/><br/>

		<div id="check-before-rule">
			<h3>“Check [...] before [...]” rule: </h3>
				<p class="user-guide-content">
					For this rule type, you have to enter 2 characters: 1 character which has to be placed before 1 other character.<br/>
					Hint: you can drag and drop special characters in inputs (see <a href="#special-characters">Special characters</a> for more information).
					<br/><br/>
					Example in Typolib’: <br/>
					<img src="/img/user-guide-screens/check_before.PNG" alt="Check before rule example" height="" width="400px" border=1 border-color="white" class="user-guide-image">
				</p>
		</div>

		<br/><br/>

		<div id="check-after-rule">
			<h3>“Check [...] after[...]” rule: </h3>
				<p class="user-guide-content">
					For this rule type, you have to enter 2 characters: 1 character which has to be placed after 1 other character.
					Hint: you can drag and drop special characters in inputs
					<br/><br/>
					Example in Typolib’: <br/>

					<img src="/img/user-guide-screens/check_after.PNG" alt="Check after rule example" height="" width="400px" border=1 border-color="white" class="user-guide-image">

					<br/>

					For this specific example, the “white-space” special character has been dragged and dropped in the first input but it is not visible here.

					<br/><br />

					You can also add (it is optional) a comment to a rule type: <br/><br/>

					<img src="/img/user-guide-screens/comment_hint_description.PNG" alt="Comment hint description" height="" width="400px" border=1 border-color="white" class="user-guide-image">
				</p>
		</div>



			<div class="notice">
		    	<h4>Notice: Case sensitivity</h4>
		    	<p>
		    		Please note that for all the rule types, case sensitivity is not managed.
				</p>
			</div>
	</div>

	<br/><br/><br/><br/>

	<div id="rule-editor-editing">
		<h2>Rules editor (Editing rules and exceptions)</h2>
			<br/><br/>
			<img src="/img/user-guide-screens/edit_rule.PNG" alt="Edit rule example" height="" width="600px" border=1 border-color="white" class="user-guide-image">

			<br/>

			<p class="user-guide-content">
				Once you have added a rule to a set of rules, you can:
				<ol>
					<li>edit the rule itself</li>
					<li>delete the rule itself</li>
					<li>edit an existing exception for this rule</li>
					<li>delete an existing exception for this rule</li>
					<li>add a new exception</li>
				</ol>
			</p>
	</div>


	<div id="check-text">
		<h2>Check text</h2>
			<br/><br/>
			<img src="/img/user-guide-screens/check_text.PNG" alt="Check text example" height="" width="800px" border=1 border-color="white" class="user-guide-image">

			<br/>

			<p class="user-guide-content">
				You can use this page if you want to check a text for all the rules you have entered for a specific set of rules and a specific locale.
				<ol>
					<li>select a locale (the language)</li>
					<li>select a specific set of rules you want to apply for the selected locale</li>
					<li>enter the text to check</li>
					<li>the “corrected“ text is displayed. All the rules from this set of rules have been applied and the errors have been corrected</li>
				</ol>
			</p>
	</div>

	<br/><br/><br/><br/>

	<div id="special-characters">
		<h2>Special characters</h2>

			<p class="user-guide-content">
				In order to add rules to a set of rules, Typolib’ can use specific characters: <br/><br/>

					<img src="/img/user-guide-screens/empty_set_special_character.PNG" alt="Empty set special character" class="user-guide-image" style="display:inline-block">
					<br/>
					You can use this special character when you want to check that there is nothing after or before a specific character for instance.

					<br/><br/>

					<img src="/img/user-guide-screens/non_breaking_space_special_character.PNG" alt="Non-breaking space special character" class="user-guide-image" style="display:inline-block">
					<br/>
					This special character is used to prevent an automatic line break (line wrap) at its position.

					<br/><br/>

					<img src="/img/user-guide-screens/white_space_special_character.PNG" alt="White space special character" class="user-guide-image" style="display:inline-block">
					<br/>
					This is the regular space character.

					<br/><br/>

					<img src="/img/user-guide-screens/narrow_non_breaking_space_special_character.PNG" alt="Narrow no-break space special character" class="user-guide-image" style="display:inline-block">
					<br/>
					This is a non-breaking space, but thinner. It is used in French for instance, before “?” and “!”.

			</p>
	</div>


</form>