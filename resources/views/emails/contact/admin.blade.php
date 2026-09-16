

<!-- 
  ✅ ContactAdminMail.php からデータをもらう

-->

<!-- 
  $validated = $request->validate([
    'name' => ['required', 'string', 'max:255'],
    // regex → Regular Expressionの略。正規表現。
    'name_kana' => ['required', 'string', 'max:255', 'regex:/^[ァ-ロワンヴー]*$/u'],
    'phone' => ['nullable', 'regex:/^0(\d-?\d{4}|\d{2}-?\d{3}|\d{3}-?\d{2}|\d{4}-?\d|\d0-?\d{4})-?\d{4}$/'],
    'email' => ['required', 'email'],
    'body' => ['required', 'string', 'max:2000'],
  ]); 
-->


{{ $contactInfo["name"] }}様よりお問い合わせ下記の内容でお問い合わせがありました
内容を確認しご対応をお願いします。

【お問い合わせ内容】
お名前: {{ $contactInfo["name"] }}
お名前（フリガナ）: {{ $contactInfo["name_kana"] }}
メールアドレス: {{ $contactInfo["email"] }}
電話番号: {{ $contactInfo["phone"] }}
お問い合わせ内容:
{{ $contactInfo["body"] }}

※このメールは配信専用のアドレスで配信されています。
このメールに返信されても返信内容の確認およびご返答ができませんので、ご了承ください。