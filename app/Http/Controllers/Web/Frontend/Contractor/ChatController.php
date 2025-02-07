<?php

namespace App\Http\Controllers\Web\Frontend\Contractor;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChatRoomResource;
use App\Services\Web\Frontend\ChatService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    protected $chatService;
    protected $user;
    public function __construct(ChatService $chatService)
    {
        $this->chatService = $chatService;
        $this->user = Auth::user();
    }
    public function index(Request $request)
    {
        $lastChatRommMessage = $this->chatService->getLastChatRoomMessage();
        if ($this->user->role === 'contractor') {
            return view('frontend.dashboard.contractor.layouts.chat.index', compact('lastChatRommMessage'));
        } else {
            return view('frontend.dashboard.customer.layouts.chat.index', compact('lastChatRommMessage'));
        }
    }
    public function chatRooms()
    {
        try {
            // Load chat rooms with customer and latest message
            $chatRooms = $this->chatService->getChatRooms();

            // Return the chat rooms as a resource collection
            return response()->json([
                'success' => true,
                'data' => ChatRoomResource::collection($chatRooms),
            ], 200);
        } catch (Exception $e) {
            Log::error("ChatController::chatRooms-" . $e->getMessage());
            return response()->json([
                'success' => false,
                'data' => $e->getMessage(),
            ], 500);
        }
    }

    // Manager sends a message to a specific chat room
    public function getMessages(string $chatRoomId)
    {
        try {
            return $this->chatService->getMessages($chatRoomId);
        } catch (Exception $e) {
            Log::error("ChatController::getMessages-" . $e->getMessage());
            return response()->json(
                ['error' => $e->getMessage()],
                500
            );
        }
    }


    // Manager sends a message to a specific chat room
    public function sendMessage(Request $request, $chatRoomId)
    {
        try {
            $validateData = $request->validate(
                [
                    'content' => 'required|string|max:10000'
                ]
            );
            // dd($chatRoomId);
            $message = $this->chatService->sendMessage($validateData, $chatRoomId);
            return response()->json([
                'success' => true,
                'messages' => $message,
            ], 201);
        } catch (Exception $e) {
            Log::error("ChatController::sendMessage-" . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function startChat($service_id)
    {
        try {
            $this->chatService->startChat($service_id);
            return redirect()->route('contractor.message.index');
        } catch (Exception $e) {
            Log::error("ChatController::startChat-" . $e->getMessage());
            return redirect()->back();
        }
    }

}
