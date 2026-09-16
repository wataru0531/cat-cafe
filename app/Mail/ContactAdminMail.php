<?php

namespace App\Mail;

// ✅ どのようなメールを作るのかを定義するクラス
// .env でMAIL_MAILER=smtp などを編集する
// → ContactController.php で制御する

// app/Mail/ContactAdminMail.php


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;


class ContactAdminMail extends Mailable {
  use Queueable, SerializesModels;

  public array $contactInfo;

  // ✅ インスタンスを作るときに実行されるコンストラクタ
  // public array $contactInfo で コンタクトフォームの各値を保存
  // → array は型
  // → bladeファイルに渡して使う。
  public function __construct(array $contactInfo) {
    // 
    $this->contactInfo = $contactInfo;
  }

  // ✅ メールのヘッダー情報を設定する
  public function envelope(): Envelope {
    return new Envelope(
      // from: $this->contactInfo["email"], // 差出人メールアドレス
      // $this ... インスタンス自身を示す。クラス内で使える特別な変数
      // 

      // 👉 Addressクラス → 安川亘  <obito0531@gmail.com> このように相手側に表示される
      from: new Address(
              $this->contactInfo["email"], // 差出人メールアドレス
              $this->contactInfo["name"]   // 差出人の名前
            ),
      subject: 'お問い合わせがありました。', // 件名
    );
  }

  // ✅ 本文のテンプレート
  public function content(): Content {
    return new Content(
      // view: 'view.name',
      
      text: "emails.contact.admin", // views/emails/contact/admin.blade.php を参照
                                  // text →プレーンテキスト形式のメール本文のこと
    );
  }

  // ✅ 添付ファイルがあるときに使う
  // public function attachments(): array {
  //     return [];
  // }
}
