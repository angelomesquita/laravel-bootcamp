<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\Chirp\BaseChirpRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Tests\TestCase;

class BaseChirpRequestTest extends TestCase
{
    private $request;

    public function setUp(): void
    {
        parent::setUp();
        $this->request = new BaseChirpRequest();
    }

    public function testShouldBePassWithMessageValid(): void
    {
        $data = ['message' => $this->getValidMessage()];
        $validator = Validator::make($data, $this->request->rules());
        $this->assertTrue($validator->passes());
    }

    public function getValidMessage(): string
    {
        return Str::random(255);
    }

    /** @dataProvider invalidData */
    public function testShouldBeFail(array $data): void
    {
        $validator = Validator::make($data, $this->request->rules());
        $this->assertTrue($validator->fails());
    }

    public function invalidData(): array
    {
        return [
           'big message' => [['message' => $this->getBigMessage()]],
           'without message' => [[]],
           'numeric message' => [['message' => 12]],
        ];
    }

    private function getBigMessage(): string
    {
        return Str::random(256);
    }
}
